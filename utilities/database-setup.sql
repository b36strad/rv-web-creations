-- ═══════════════════════════════════════════════════════
-- RV WEB CREATIONS - DATABASE SETUP
-- ═══════════════════════════════════════════════════════
-- This creates the database and table structure for storing
-- project intake form submissions
-- 
-- Run this once to set up your database

-- Create database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS rv_web_creations 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE rv_web_creations;

-- ═══════════════════════════════════════════════════════
-- PROJECT INTAKES TABLE
-- ═══════════════════════════════════════════════════════
-- Stores all project intake form submissions

CREATE TABLE IF NOT EXISTS project_intakes (
    -- Primary Key
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- 1. Basic Business Information
    company_name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    preferred_communication TEXT,
    current_website VARCHAR(500),
    business_address TEXT,
    
    -- 2. Business Overview & Goals
    business_description TEXT,
    website_goals TEXT,
    primary_action TEXT,
    business_priorities TEXT,
    
    -- 3. Target Audience
    ideal_customer TEXT,
    multiple_audiences TEXT,
    audience_problems TEXT,
    
    -- 4. Branding Requirements
    branding_status VARCHAR(100),
    branding_assets TEXT,
    brand_personality TEXT,
    
    -- 5. Website Content
    content_status VARCHAR(100),
    images_options TEXT,
    pages_needed TEXT,
    
    -- 6. Website Features & Functionality
    features TEXT,
    num_products VARCHAR(50),
    product_categories TEXT,
    ecommerce_options TEXT,
    shipping_options TEXT,
    payment_options TEXT,
    
    -- 7. Competitor & Inspiration Research
    websites_liked TEXT,
    competitor_sites TEXT,
    dislikes TEXT,
    
    -- 8. SEO, Marketing & Performance
    seo_services TEXT,
    tracking_tools TEXT,
    seo_copywriting VARCHAR(50),
    
    -- 9. Technical Requirements
    platform VARCHAR(100),
    hosting VARCHAR(100),
    domain_status VARCHAR(100),
    security TEXT,
    
    -- 10. Maintenance & Ongoing Support
    maintenance_options TEXT,
    site_updater VARCHAR(100),
    
    -- 11. Budget & Timeline
    budget VARCHAR(100),
    timeline VARCHAR(100),
    timeline_date DATE,
    
    -- 12. Project Priority & Decision-Making
    urgency TINYINT,
    decision_maker VARCHAR(255),
    possible_delays TEXT,
    
    -- 13. Content Readiness & Migration
    existing_website VARCHAR(10),
    existing_url VARCHAR(500),
    migration_details TEXT,
    
    -- 14. Ongoing Support Preferences
    maintenance_interest VARCHAR(50),
    support_needs TEXT,
    maintenance_billing VARCHAR(50),
    hosting_needed VARCHAR(50),
    
    -- 15. Payment & Contract Preferences
    referral_source VARCHAR(100),
    referral_name VARCHAR(255),
    nonprofit_status VARCHAR(10),
    payment_preference VARCHAR(100),
    
    -- 16. Additional Notes
    additional_notes TEXT,
    
    -- System Fields
    submitted_at DATETIME NOT NULL,
    ip_address VARCHAR(45),
    status ENUM('new', 'contacted', 'proposal_sent', 'negotiating', 'accepted', 'declined', 'on_hold') DEFAULT 'new',
    status_notes TEXT,
    estimated_value DECIMAL(10, 2),
    proposal_sent_at DATETIME,
    followed_up_at DATETIME,
    closed_at DATETIME,
    assigned_to VARCHAR(100),
    
    -- Indexes for common queries
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_submitted_at (submitted_at),
    INDEX idx_company_name (company_name),
    INDEX idx_budget (budget)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ═══════════════════════════════════════════════════════
-- PROPOSAL TRACKING TABLE (Optional)
-- ═══════════════════════════════════════════════════════
-- Track proposals sent to clients

CREATE TABLE IF NOT EXISTS proposals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    intake_id INT NOT NULL,
    proposal_number VARCHAR(50) UNIQUE,
    client_name VARCHAR(255) NOT NULL,
    client_email VARCHAR(255) NOT NULL,
    project_name VARCHAR(255),
    
    -- Proposal Details
    base_package ENUM('Starter', 'Growth', 'Custom', 'Refresh') NOT NULL,
    num_pages INT,
    has_ecommerce BOOLEAN DEFAULT FALSE,
    num_products INT,
    content_level VARCHAR(50),
    timeline_weeks INT,
    
    -- Pricing
    base_price DECIMAL(10, 2),
    addons_total DECIMAL(10, 2),
    timeline_adjustment DECIMAL(10, 2),
    discount_amount DECIMAL(10, 2),
    discount_reason VARCHAR(255),
    final_total DECIMAL(10, 2) NOT NULL,
    
    -- Payment Schedule
    deposit_amount DECIMAL(10, 2),
    milestone1_amount DECIMAL(10, 2),
    milestone2_amount DECIMAL(10, 2),
    final_payment_amount DECIMAL(10, 2),
    
    -- Proposal Status
    status ENUM('draft', 'sent', 'viewed', 'accepted', 'declined', 'expired') DEFAULT 'draft',
    sent_at DATETIME,
    viewed_at DATETIME,
    responded_at DATETIME,
    expires_at DATE,
    
    -- File Storage
    proposal_pdf_path VARCHAR(500),
    contract_pdf_path VARCHAR(500),
    
    -- Notes
    internal_notes TEXT,
    client_questions TEXT,
    
    -- Timestamps
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign Key
    FOREIGN KEY (intake_id) REFERENCES project_intakes(id) ON DELETE CASCADE,
    
    -- Indexes
    INDEX idx_intake_id (intake_id),
    INDEX idx_status (status),
    INDEX idx_client_email (client_email),
    INDEX idx_sent_at (sent_at)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ═══════════════════════════════════════════════════════
-- PROJECTS TABLE (Optional)
-- ═══════════════════════════════════════════════════════
-- Track active projects after proposal acceptance

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    intake_id INT,
    proposal_id INT,
    
    -- Project Info
    project_number VARCHAR(50) UNIQUE,
    client_name VARCHAR(255) NOT NULL,
    client_email VARCHAR(255) NOT NULL,
    project_name VARCHAR(255) NOT NULL,
    
    -- Contract Details
    contract_value DECIMAL(10, 2) NOT NULL,
    deposit_paid BOOLEAN DEFAULT FALSE,
    deposit_paid_at DATETIME,
    
    -- Project Timeline
    start_date DATE,
    estimated_launch DATE,
    actual_launch DATE,
    
    -- Project Status
    status ENUM('pending_deposit', 'in_progress', 'client_review', 'revisions', 'ready_to_launch', 'launched', 'on_hold', 'cancelled') DEFAULT 'pending_deposit',
    current_phase VARCHAR(100),
    
    -- Milestones
    milestone1_completed BOOLEAN DEFAULT FALSE,
    milestone1_completed_at DATETIME,
    milestone1_paid BOOLEAN DEFAULT FALSE,
    milestone2_completed BOOLEAN DEFAULT FALSE,
    milestone2_completed_at DATETIME,
    milestone2_paid BOOLEAN DEFAULT FALSE,
    final_paid BOOLEAN DEFAULT FALSE,
    final_paid_at DATETIME,
    
    -- Hosting & Maintenance
    hosting_included BOOLEAN DEFAULT FALSE,
    maintenance_plan VARCHAR(50),
    maintenance_start_date DATE,
    
    -- Files & URLs
    staging_url VARCHAR(500),
    live_url VARCHAR(500),
    project_folder_path VARCHAR(500),
    
    -- Time Tracking
    estimated_hours DECIMAL(5, 1),
    actual_hours DECIMAL(5, 1),
    
    -- Notes
    project_notes TEXT,
    client_feedback TEXT,
    
    -- Timestamps
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign Keys
    FOREIGN KEY (intake_id) REFERENCES project_intakes(id) ON DELETE SET NULL,
    FOREIGN KEY (proposal_id) REFERENCES proposals(id) ON DELETE SET NULL,
    
    -- Indexes
    INDEX idx_status (status),
    INDEX idx_client_email (client_email),
    INDEX idx_launch_date (estimated_launch)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ═══════════════════════════════════════════════════════
-- NOTES TABLE (Optional)
-- ═══════════════════════════════════════════════════════
-- Track all communications and notes

CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    related_to ENUM('intake', 'proposal', 'project') NOT NULL,
    related_id INT NOT NULL,
    
    note_type ENUM('email', 'call', 'meeting', 'internal', 'client_request') NOT NULL,
    subject VARCHAR(255),
    note_text TEXT NOT NULL,
    
    created_by VARCHAR(100),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_related (related_to, related_id),
    INDEX idx_created_at (created_at)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ═══════════════════════════════════════════════════════
-- INITIAL DATA / SAMPLE QUERIES
-- ═══════════════════════════════════════════════════════

-- View all new intakes (not yet contacted)
-- SELECT * FROM project_intakes WHERE status = 'new' ORDER BY submitted_at DESC;

-- View intakes by budget range
-- SELECT company_name, email, budget, timeline, submitted_at 
-- FROM project_intakes 
-- WHERE budget LIKE '%$7,500%' OR budget LIKE '%$12,000%' OR budget LIKE '%$18,000%'
-- ORDER BY submitted_at DESC;

-- View proposals pending response
-- SELECT p.*, pi.company_name, pi.email 
-- FROM proposals p
-- JOIN project_intakes pi ON p.intake_id = pi.id
-- WHERE p.status = 'sent' 
-- ORDER BY p.sent_at DESC;

-- View active projects
-- SELECT * FROM projects WHERE status = 'in_progress' ORDER BY estimated_launch;

-- View all communications for a specific intake
-- SELECT * FROM notes WHERE related_to = 'intake' AND related_id = 1 ORDER BY created_at DESC;

-- ═══════════════════════════════════════════════════════
-- SETUP COMPLETE
-- ═══════════════════════════════════════════════════════
-- Next steps:
-- 1. Update intake-handler.php with your database credentials
-- 2. Test form submission
-- 3. Build admin dashboard to view/manage intakes
-- 4. Set up proposal generation workflow
