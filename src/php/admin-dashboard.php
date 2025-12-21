<?php
/**
 * RV WEB CREATIONS - ADMIN DASHBOARD
 * View and manage project intake submissions
 * 
 * SECURITY: Add authentication before using in production!
 */

session_start();
require_once __DIR__ . '/admin-config.php';
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin-login.html');
    exit;
}

// ═══════════════════════════════════════════════════════
// DATABASE CONNECTION
// ═══════════════════════════════════════════════════════
define('DB_HOST', 'localhost');
define('DB_NAME', 'rv_web_creations');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// ═══════════════════════════════════════════════════════
// HANDLE ACTIONS
// ═══════════════════════════════════════════════════════
$message = '';

// Update status
if (isset($_POST['update_status']) && isset($_POST['intake_id']) && isset($_POST['new_status'])) {
    $stmt = $pdo->prepare("UPDATE project_intakes SET status = ?, status_notes = ? WHERE id = ?");
    $stmt->execute([$_POST['new_status'], $_POST['status_notes'] ?? '', $_POST['intake_id']]);
    $message = "Status updated successfully!";
}

// Update estimated value
if (isset($_POST['update_value']) && isset($_POST['intake_id']) && isset($_POST['estimated_value'])) {
    $stmt = $pdo->prepare("UPDATE project_intakes SET estimated_value = ? WHERE id = ?");
    $stmt->execute([$_POST['estimated_value'], $_POST['intake_id']]);
    $message = "Estimated value updated!";
}

// Mark as followed up
if (isset($_GET['followup']) && isset($_GET['id'])) {
    $stmt = $pdo->prepare("UPDATE project_intakes SET followed_up_at = NOW() WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $message = "Marked as followed up!";
}

// Delete intake
if (isset($_POST['delete_intake']) && isset($_POST['intake_id'])) {
    $stmt = $pdo->prepare("DELETE FROM project_intakes WHERE id = ?");
    $stmt->execute([$_POST['intake_id']]);
    $message = "Intake deleted!";
}

// ═══════════════════════════════════════════════════════
// GET FILTER PARAMETERS
// ═══════════════════════════════════════════════════════
$filter_status = $_GET['status'] ?? 'all';
$filter_budget = $_GET['budget'] ?? 'all';
$search = $_GET['search'] ?? '';
$sort_by = $_GET['sort'] ?? 'submitted_at';
$sort_dir = $_GET['dir'] ?? 'DESC';

// Build query
$where_clauses = [];
$params = [];

if ($filter_status !== 'all') {
    $where_clauses[] = "status = ?";
    $params[] = $filter_status;
}

if ($filter_budget !== 'all') {
    $where_clauses[] = "budget LIKE ?";
    $params[] = "%{$filter_budget}%";
}

if ($search) {
    $where_clauses[] = "(company_name LIKE ? OR email LIKE ? OR contact_person LIKE ?)";
    $search_term = "%{$search}%";
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
}

$where_sql = $where_clauses ? "WHERE " . implode(" AND ", $where_clauses) : "";

// Get intakes
$sql = "SELECT * FROM project_intakes {$where_sql} ORDER BY {$sort_by} {$sort_dir}";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$intakes = $stmt->fetchAll();

// Get statistics
$stats = $pdo->query("
    SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new,
        SUM(CASE WHEN status = 'contacted' THEN 1 ELSE 0 END) as contacted,
        SUM(CASE WHEN status = 'proposal_sent' THEN 1 ELSE 0 END) as proposal_sent,
        SUM(CASE WHEN status = 'accepted' THEN 1 ELSE 0 END) as accepted,
        SUM(estimated_value) as total_pipeline_value
    FROM project_intakes
")->fetch();

// Logout handler
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin-dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - RV Web Creations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        .intake-row:hover {
            background-color: #f8f9fa;
        }
        .stat-card {
            border-left: 4px solid #1f4f7b;
        }
        .urgent {
            border-left-color: #dc3545 !important;
        }
        .high-value {
            background-color: #fff3cd;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">
                <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                    <rect width="40" height="40" rx="8" fill="#1f4f7b"/>
                    <path d="M10 28V12H14C15.5 12 16.5 12.3 17.5 13C18.5 13.7 19 14.8 19 16.2C19 17 18.8 17.7 18.4 18.3C18 18.9 17.4 19.3 16.6 19.5L19.5 28H16.5L13.8 20H12.5V28H10ZM12.5 18H14C14.8 18 15.4 17.8 15.8 17.4C16.2 17 16.4 16.4 16.4 15.7C16.4 15 16.2 14.5 15.8 14.1C15.4 13.7 14.8 13.5 14 13.5H12.5V18Z" fill="#f8b400"/>
                    <path d="M23 12L26.5 28H29L32.5 12H30L27.75 23L25.5 12H23Z" fill="white"/>
                </svg>
                RV Web Creations - Admin Dashboard
            </span>
            <a href="?logout=1" class="btn btn-sm btn-outline-light">Logout</a>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-2">
                <div class="card stat-card">
                    <div class="card-body">
                        <h6 class="text-muted small mb-1">Total Intakes</h6>
                        <h3 class="mb-0"><?php echo $stats['total']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card stat-card" style="border-left-color: #dc3545;">
                    <div class="card-body">
                        <h6 class="text-muted small mb-1">New</h6>
                        <h3 class="mb-0 text-danger"><?php echo $stats['new']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card stat-card" style="border-left-color: #ffc107;">
                    <div class="card-body">
                        <h6 class="text-muted small mb-1">Contacted</h6>
                        <h3 class="mb-0 text-warning"><?php echo $stats['contacted']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card stat-card" style="border-left-color: #0dcaf0;">
                    <div class="card-body">
                        <h6 class="text-muted small mb-1">Proposals Sent</h6>
                        <h3 class="mb-0 text-info"><?php echo $stats['proposal_sent']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card stat-card" style="border-left-color: #198754;">
                    <div class="card-body">
                        <h6 class="text-muted small mb-1">Accepted</h6>
                        <h3 class="mb-0 text-success"><?php echo $stats['accepted']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card stat-card" style="border-left-color: #28a745;">
                    <div class="card-body">
                        <h6 class="text-muted small mb-1">Pipeline Value</h6>
                        <h3 class="mb-0 text-success">$<?php echo number_format($stats['total_pipeline_value'] ?? 0); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="all" <?php echo $filter_status === 'all' ? 'selected' : ''; ?>>All Statuses</option>
                            <option value="new" <?php echo $filter_status === 'new' ? 'selected' : ''; ?>>New</option>
                            <option value="contacted" <?php echo $filter_status === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                            <option value="proposal_sent" <?php echo $filter_status === 'proposal_sent' ? 'selected' : ''; ?>>Proposal Sent</option>
                            <option value="negotiating" <?php echo $filter_status === 'negotiating' ? 'selected' : ''; ?>>Negotiating</option>
                            <option value="accepted" <?php echo $filter_status === 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                            <option value="declined" <?php echo $filter_status === 'declined' ? 'selected' : ''; ?>>Declined</option>
                            <option value="on_hold" <?php echo $filter_status === 'on_hold' ? 'selected' : ''; ?>>On Hold</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Budget Range</label>
                        <select name="budget" class="form-select form-select-sm">
                            <option value="all">All Budgets</option>
                            <option value="$2,500">$2,500-$6,000</option>
                            <option value="$7,500">$7,500-$12,000</option>
                            <option value="$12,000">$12,000-$18,000</option>
                            <option value="$18,000">$18,000+</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Company, email, or contact name" value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Intakes Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Project Intakes (<?php echo count($intakes); ?>)</h5>
                <a href="../index.html" class="btn btn-sm btn-outline-primary" target="_blank">View Website</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Budget</th>
                            <th>Timeline</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($intakes)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No intakes found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($intakes as $intake): ?>
                                <tr class="intake-row <?php echo ($intake['urgency'] >= 8) ? 'urgent' : ''; ?>">
                                    <td><strong>#<?php echo $intake['id']; ?></strong></td>
                                    <td class="small"><?php echo date('M j, Y', strtotime($intake['submitted_at'])); ?></td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($intake['company_name']); ?></strong>
                                        <?php if ($intake['urgency'] >= 8): ?>
                                            <span class="badge bg-danger ms-1">Urgent</span>
                                        <?php endif; ?>
                                        <?php if ($intake['nonprofit_status'] === 'Yes'): ?>
                                            <span class="badge bg-info ms-1">Nonprofit</span>
                                        <?php endif; ?>
                                        <?php if ($intake['referral_name']): ?>
                                            <span class="badge bg-success ms-1">Referral</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="small">
                                        <?php echo htmlspecialchars($intake['contact_person']); ?><br>
                                        <a href="mailto:<?php echo htmlspecialchars($intake['email']); ?>" class="text-decoration-none">
                                            <?php echo htmlspecialchars($intake['email']); ?>
                                        </a>
                                    </td>
                                    <td><span class="badge bg-primary"><?php echo htmlspecialchars($intake['budget']); ?></span></td>
                                    <td class="small"><?php echo htmlspecialchars($intake['timeline']); ?></td>
                                    <td>
                                        <?php
                                        $status_colors = [
                                            'new' => 'danger',
                                            'contacted' => 'warning',
                                            'proposal_sent' => 'info',
                                            'negotiating' => 'primary',
                                            'accepted' => 'success',
                                            'declined' => 'secondary',
                                            'on_hold' => 'dark'
                                        ];
                                        $color = $status_colors[$intake['status']] ?? 'secondary';
                                        ?>
                                        <span class="badge bg-<?php echo $color; ?> status-badge">
                                            <?php echo ucfirst(str_replace('_', ' ', $intake['status'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="pricing-calculator.php?intake_id=<?php echo $intake['id']; ?>" class="btn btn-sm btn-success" title="Calculate Pricing">
                                            <svg width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                                                <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                                                <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
                                            </svg>
                                        </a>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $intake['id']; ?>">
                                            View
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $intake['id']; ?>">
                                            Edit
                                        </button>
                                    </td>
                                </tr>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewModal<?php echo $intake['id']; ?>" tabindex="-1">
                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Intake #<?php echo $intake['id']; ?> - <?php echo htmlspecialchars($intake['company_name']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-4">
                                                    <div class="col-md-6">
                                                        <h6 class="border-bottom pb-2">Basic Information</h6>
                                                        <table class="table table-sm">
                                                            <tr><th class="w-50">Company:</th><td><?php echo htmlspecialchars($intake['company_name']); ?></td></tr>
                                                            <tr><th>Contact Person:</th><td><?php echo htmlspecialchars($intake['contact_person']); ?></td></tr>
                                                            <tr><th>Email:</th><td><a href="mailto:<?php echo htmlspecialchars($intake['email']); ?>"><?php echo htmlspecialchars($intake['email']); ?></a></td></tr>
                                                            <tr><th>Phone:</th><td><?php echo htmlspecialchars($intake['phone']); ?></td></tr>
                                                            <tr><th>Current Website:</th><td><?php echo htmlspecialchars($intake['current_website']); ?></td></tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="border-bottom pb-2">Budget & Timeline</h6>
                                                        <table class="table table-sm">
                                                            <tr><th class="w-50">Budget:</th><td><strong><?php echo htmlspecialchars($intake['budget']); ?></strong></td></tr>
                                                            <tr><th>Timeline:</th><td><?php echo htmlspecialchars($intake['timeline']); ?></td></tr>
                                                            <tr><th>Specific Date:</th><td><?php echo $intake['timeline_date'] ? date('M j, Y', strtotime($intake['timeline_date'])) : 'N/A'; ?></td></tr>
                                                            <tr><th>Urgency (1-10):</th><td><?php echo $intake['urgency'] ? $intake['urgency'] . '/10' : 'N/A'; ?></td></tr>
                                                            <tr><th>Decision Maker:</th><td><?php echo htmlspecialchars($intake['decision_maker']); ?></td></tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-12">
                                                        <h6 class="border-bottom pb-2">Business Description</h6>
                                                        <p><?php echo nl2br(htmlspecialchars($intake['business_description'])); ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="border-bottom pb-2">Website Goals</h6>
                                                        <p><?php echo nl2br(htmlspecialchars($intake['website_goals'])); ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="border-bottom pb-2">Target Audience</h6>
                                                        <p><?php echo nl2br(htmlspecialchars($intake['ideal_customer'])); ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="border-bottom pb-2">Content Status</h6>
                                                        <p><?php echo htmlspecialchars($intake['content_status']); ?></p>
                                                        <?php if ($intake['existing_website'] === 'Yes'): ?>
                                                            <p><strong>Existing Site:</strong> <a href="<?php echo htmlspecialchars($intake['existing_url']); ?>" target="_blank"><?php echo htmlspecialchars($intake['existing_url']); ?></a></p>
                                                            <p><strong>Migration:</strong> <?php echo nl2br(htmlspecialchars($intake['migration_details'])); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="border-bottom pb-2">Ongoing Support</h6>
                                                        <p><strong>Interest:</strong> <?php echo htmlspecialchars($intake['maintenance_interest']); ?></p>
                                                        <p><strong>Needs:</strong> <?php echo htmlspecialchars($intake['support_needs']); ?></p>
                                                        <p><strong>Hosting:</strong> <?php echo htmlspecialchars($intake['hosting_needed']); ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="border-bottom pb-2">Referral & Discounts</h6>
                                                        <p><strong>Source:</strong> <?php echo htmlspecialchars($intake['referral_source']); ?></p>
                                                        <?php if ($intake['referral_name']): ?>
                                                            <p><strong>Referred by:</strong> <?php echo htmlspecialchars($intake['referral_name']); ?></p>
                                                        <?php endif; ?>
                                                        <?php if ($intake['nonprofit_status'] === 'Yes'): ?>
                                                            <p><span class="badge bg-info">Nonprofit Organization</span></p>
                                                        <?php endif; ?>
                                                        <p><strong>Payment Preference:</strong> <?php echo htmlspecialchars($intake['payment_preference']); ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="border-bottom pb-2">Features Requested</h6>
                                                        <p><?php echo nl2br(htmlspecialchars($intake['features'])); ?></p>
                                                        <p><strong>Pages:</strong> <?php echo htmlspecialchars($intake['pages_needed']); ?></p>
                                                    </div>
                                                    <?php if ($intake['additional_notes']): ?>
                                                    <div class="col-12">
                                                        <h6 class="border-bottom pb-2">Additional Notes</h6>
                                                        <p><?php echo nl2br(htmlspecialchars($intake['additional_notes'])); ?></p>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="mailto:<?php echo htmlspecialchars($intake['email']); ?>?subject=RE: Project Intake - <?php echo urlencode($intake['company_name']); ?>" class="btn btn-primary">Send Email</a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal<?php echo $intake['id']; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Intake #<?php echo $intake['id']; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="intake_id" value="<?php echo $intake['id']; ?>">
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="new_status" class="form-select" required>
                                                            <option value="new" <?php echo $intake['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                                            <option value="contacted" <?php echo $intake['status'] === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                                                            <option value="proposal_sent" <?php echo $intake['status'] === 'proposal_sent' ? 'selected' : ''; ?>>Proposal Sent</option>
                                                            <option value="negotiating" <?php echo $intake['status'] === 'negotiating' ? 'selected' : ''; ?>>Negotiating</option>
                                                            <option value="accepted" <?php echo $intake['status'] === 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                                                            <option value="declined" <?php echo $intake['status'] === 'declined' ? 'selected' : ''; ?>>Declined</option>
                                                            <option value="on_hold" <?php echo $intake['status'] === 'on_hold' ? 'selected' : ''; ?>>On Hold</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Status Notes</label>
                                                        <textarea name="status_notes" class="form-control" rows="3"><?php echo htmlspecialchars($intake['status_notes'] ?? ''); ?></textarea>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Estimated Value ($)</label>
                                                        <input type="number" name="estimated_value" class="form-control" value="<?php echo $intake['estimated_value'] ?? ''; ?>" step="100">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="update_status" class="btn btn-primary">Save Changes</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
