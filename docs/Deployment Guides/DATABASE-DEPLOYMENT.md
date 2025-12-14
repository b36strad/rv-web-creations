# 🗄️ Database Deployment Instructions

**Step-by-step guide to set up your MySQL database for RV Web Creations**

---

## 📋 PREREQUISITES

Before you begin, ensure you have:

- ✅ MySQL 8.0+ installed (or access to hosting MySQL)
- ✅ MySQL root or admin access
- ✅ Terminal/Command line access OR phpMyAdmin
- ✅ The `database-setup.sql` file from this project

**Check MySQL version:**
```bash
mysql --version
```

---

## 🚀 DEPLOYMENT OPTIONS

Choose the method that works best for your environment:

### **Option 1: Command Line (Recommended)**
- Fast and reliable
- Works on local development and production
- Best for developers comfortable with terminal

### **Option 2: phpMyAdmin (Web Interface)**
- Visual interface
- Good for shared hosting
- Easy for beginners

### **Option 3: MySQL Workbench (GUI)**
- Desktop application
- Visual schema design
- Good for local development

---

## 💻 OPTION 1: COMMAND LINE DEPLOYMENT

### **Step 1: Connect to MySQL**

```bash
mysql -u root -p
```

**Enter your MySQL root password when prompted.**

**For hosting environments:**
```bash
mysql -u your_username -p -h your_host
```

---

### **Step 2: Create Database**

```sql
CREATE DATABASE rv_web_creations CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Verify creation:**
```sql
SHOW DATABASES;
```

**You should see `rv_web_creations` in the list.**

---

### **Step 3: Create Database User (Optional but Recommended)**

**For security, create a dedicated user instead of using root:**

```sql
CREATE USER 'rvweb_user'@'localhost' IDENTIFIED BY 'your_secure_password_here';
```

**Grant privileges:**
```sql
GRANT ALL PRIVILEGES ON rv_web_creations.* TO 'rvweb_user'@'localhost';
FLUSH PRIVILEGES;
```

**⚠️ IMPORTANT:** Replace `'your_secure_password_here'` with a strong password!

**For remote access (if deploying to separate DB server):**
```sql
CREATE USER 'rvweb_user'@'%' IDENTIFIED BY 'your_secure_password_here';
GRANT ALL PRIVILEGES ON rv_web_creations.* TO 'rvweb_user'@'%';
FLUSH PRIVILEGES;
```

---

### **Step 4: Exit MySQL and Import Schema**

```sql
EXIT;
```

**Navigate to your project directory:**
```bash
cd "/path/to/RV Web Creations"
```

**Import the database schema:**
```bash
mysql -u root -p rv_web_creations < database-setup.sql
```

**Or with your new user:**
```bash
mysql -u rvweb_user -p rv_web_creations < database-setup.sql
```

**Enter password when prompted.**

---

### **Step 5: Verify Tables Created**

```bash
mysql -u root -p rv_web_creations
```

```sql
SHOW TABLES;
```

**You should see:**
```
+------------------------------+
| Tables_in_rv_web_creations   |
+------------------------------+
| notes                        |
| project_intakes              |
| projects                     |
| proposals                    |
+------------------------------+
4 rows in set
```

**Check table structure:**
```sql
DESCRIBE project_intakes;
```

**Should show 53+ columns including:**
- id
- company_name
- email
- budget
- status
- submitted_at
- etc.

**Exit MySQL:**
```sql
EXIT;
```

---

## 🌐 OPTION 2: PHPMYADMIN DEPLOYMENT

**Ideal for shared hosting or if you prefer a visual interface.**

### **Step 1: Access phpMyAdmin**

- Open your hosting control panel (cPanel, Plesk, etc.)
- Click on phpMyAdmin icon
- Or navigate to: `https://yourdomain.com/phpmyadmin`
- Log in with your MySQL credentials

---

### **Step 2: Create Database**

**Method A: Using phpMyAdmin Interface**
1. Click "Databases" tab at the top
2. Under "Create database":
   - Database name: `rv_web_creations`
   - Collation: `utf8mb4_unicode_ci`
3. Click "Create"

**Method B: Using SQL Tab**
1. Click "SQL" tab at the top
2. Paste this code:
   ```sql
   CREATE DATABASE rv_web_creations CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Click "Go"

---

### **Step 3: Create Database User (Optional)**

1. Click "User accounts" tab
2. Click "Add user account"
3. Fill in details:
   - **User name:** `rvweb_user`
   - **Host name:** `localhost` (or `%` for any host)
   - **Password:** Enter a strong password
   - **Re-type:** Confirm password
4. Under "Database for user account":
   - ☑️ Check "Grant all privileges on database rv_web_creations"
5. Click "Go"

---

### **Step 4: Import Schema**

1. Click "Databases" in top menu
2. Click on `rv_web_creations` database
3. Click "Import" tab at the top
4. Click "Choose File" button
5. Navigate to and select `database-setup.sql`
6. Scroll down and click "Go"

**Wait for import to complete...**

**Success message should appear:**
```
Import has been successfully finished, 4 queries executed.
```

---

### **Step 5: Verify Tables**

1. Click on `rv_web_creations` database in left sidebar
2. You should see 4 tables:
   - notes
   - project_intakes
   - projects
   - proposals

3. Click on `project_intakes` to verify structure
4. Click "Structure" tab to see all 53 columns

---

## 🖥️ OPTION 3: MYSQL WORKBENCH DEPLOYMENT

**Good for local development with visual interface.**

### **Step 1: Open MySQL Workbench**

- Launch MySQL Workbench application
- Click on your local MySQL connection
- Or create new connection if needed

---

### **Step 2: Create Database**

1. Click "SQL +" icon to open new query tab
2. Paste this code:
   ```sql
   CREATE DATABASE rv_web_creations CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Click lightning bolt icon (Execute) or press `Ctrl+Enter`

---

### **Step 3: Import Schema**

**Method A: File → Run SQL Script**
1. Click "File" → "Run SQL Script"
2. Navigate to `database-setup.sql`
3. Select it and click "Open"
4. Select `rv_web_creations` as default schema
5. Click "Run"

**Method B: Open and Execute**
1. Click "File" → "Open SQL Script"
2. Navigate to `database-setup.sql`
3. Click "Open"
4. Ensure `rv_web_creations` is selected in schema dropdown
5. Click lightning bolt icon to execute

---

### **Step 4: Verify Tables**

1. Click "Schemas" tab in left sidebar
2. Right-click and select "Refresh All"
3. Expand `rv_web_creations` database
4. Expand "Tables" folder
5. You should see 4 tables

6. Right-click `project_intakes` → "Select Rows - Limit 1000"
7. Should show empty table with 53 columns

---

## ⚙️ UPDATE PHP FILES WITH DATABASE CREDENTIALS

**After database creation, update these files with your credentials:**

### **Files to Update:**

1. `src/contact-handler.php`
2. `src/intake-handler.php`
3. `src/admin-dashboard.php`
4. `src/pricing-calculator.php`

---

### **What to Change:**

**Find these lines in each file:**
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'rv_web_creations');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

**Replace with your actual credentials:**

**For Local Development:**
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'rv_web_creations');
define('DB_USER', 'root');              // or 'rvweb_user' if you created one
define('DB_PASS', 'your_mysql_password'); // your actual MySQL password
```

**For Production/Hosting:**
```php
define('DB_HOST', 'localhost');          // or your DB host (e.g., 'db.example.com')
define('DB_NAME', 'rv_web_creations');   // might have prefix (e.g., 'username_rvweb')
define('DB_USER', 'rvweb_user');         // your database username
define('DB_PASS', 'your_secure_password'); // your database password
```

**⚠️ SECURITY NOTES:**
- Never commit database passwords to Git
- Use strong passwords (16+ characters, mixed case, numbers, symbols)
- Consider using environment variables (`.env` file) in production
- Different passwords for development vs production

---

## 🔒 SECURITY BEST PRACTICES

### **1. Use Strong Passwords**

**Bad password:** `password123`  
**Good password:** `Kp#9mX$2nQ@7vL!4wR`

**Generate secure password:**
```bash
# On macOS/Linux:
openssl rand -base64 24

# Result: Something like: 7Kj9#mX$2nQ@7vL!4wR8pT
```

---

### **2. Restrict Database User Privileges**

**Only grant necessary permissions:**
```sql
-- Instead of ALL PRIVILEGES, be specific:
GRANT SELECT, INSERT, UPDATE, DELETE ON rv_web_creations.* TO 'rvweb_user'@'localhost';
```

**For production, NO DROP or ALTER permissions needed.**

---

### **3. Restrict Host Access**

**Local only:**
```sql
CREATE USER 'rvweb_user'@'localhost' IDENTIFIED BY 'password';
-- Can only connect from same server
```

**Remote access (only if needed):**
```sql
CREATE USER 'rvweb_user'@'192.168.1.100' IDENTIFIED BY 'password';
-- Can only connect from specific IP
```

---

### **4. Backup Database Regularly**

**Manual backup:**
```bash
mysqldump -u rvweb_user -p rv_web_creations > backup-$(date +%Y-%m-%d).sql
```

**Automated backup (cron job - runs daily at 2 AM):**
```bash
0 2 * * * /usr/bin/mysqldump -u rvweb_user -pYOUR_PASSWORD rv_web_creations > /backups/rv-web-$(date +\%Y-\%m-\%d).sql
```

---

### **5. Use Environment Variables (Recommended for Production)**

**Create `.env` file (DO NOT commit to Git):**
```env
DB_HOST=localhost
DB_NAME=rv_web_creations
DB_USER=rvweb_user
DB_PASS=your_secure_password
```

**Add to `.gitignore`:**
```
.env
```

**Load in PHP:**
```php
// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
    define('DB_HOST', $env['DB_HOST']);
    define('DB_NAME', $env['DB_NAME']);
    define('DB_USER', $env['DB_USER']);
    define('DB_PASS', $env['DB_PASS']);
}
```

---

## ✅ TESTING YOUR DATABASE

### **Test 1: Connection Test**

**Create `test-db-connection.php`:**
```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'rv_web_creations');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "✅ Database connection successful!\n";
    echo "Database: " . DB_NAME . "\n";
    
    // Test query
    $stmt = $pdo->query("SELECT COUNT(*) FROM project_intakes");
    $count = $stmt->fetchColumn();
    echo "✅ Tables accessible! Current intakes: " . $count . "\n";
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
}
?>
```

**Run test:**
```bash
php test-db-connection.php
```

**Expected output:**
```
✅ Database connection successful!
Database: rv_web_creations
✅ Tables accessible! Current intakes: 0
```

**⚠️ DELETE THIS FILE after testing!** (Contains credentials)

---

### **Test 2: Form Submission Test**

1. Navigate to your project intake form
2. Fill out all 16 sections
3. Submit form
4. Check for success message
5. Verify in database:

```sql
SELECT id, company_name, email, submitted_at, status 
FROM project_intakes 
ORDER BY submitted_at DESC 
LIMIT 1;
```

---

### **Test 3: Admin Dashboard Test**

1. Navigate to `admin-dashboard.php`
2. Log in with admin password
3. Verify you see the test intake submission
4. Click "View" to see all details
5. Click "Calculate Pricing" to test calculator
6. Change status and save

---

## 🚨 TROUBLESHOOTING

### **Error: Access denied for user**

```
ERROR 1045 (28000): Access denied for user 'rvweb_user'@'localhost'
```

**Solutions:**
- ✅ Check username is correct
- ✅ Check password is correct
- ✅ Verify user was created: `SELECT User FROM mysql.user;`
- ✅ Check privileges: `SHOW GRANTS FOR 'rvweb_user'@'localhost';`

---

### **Error: Database does not exist**

```
ERROR 1049 (42000): Unknown database 'rv_web_creations'
```

**Solutions:**
- ✅ Verify database exists: `SHOW DATABASES;`
- ✅ Create database if missing (see Step 2)
- ✅ Check for typos in database name

---

### **Error: Table doesn't exist**

```
ERROR 1146 (42S02): Table 'rv_web_creations.project_intakes' doesn't exist
```

**Solutions:**
- ✅ Verify tables imported: `SHOW TABLES;`
- ✅ Re-run `database-setup.sql` import
- ✅ Check for SQL errors during import

---

### **Error: Connection refused**

```
ERROR 2002 (HY000): Can't connect to MySQL server on 'localhost'
```

**Solutions:**
- ✅ Verify MySQL is running: `sudo systemctl status mysql` (Linux)
- ✅ Check MySQL is running: `ps aux | grep mysql` (macOS)
- ✅ Start MySQL: `sudo systemctl start mysql` or `brew services start mysql`
- ✅ Check port: MySQL default is 3306

---

### **Error: PDO driver not found**

```
Fatal error: Uncaught Error: Call to undefined function PDO()
```

**Solutions:**
- ✅ Install PHP PDO MySQL extension:
  - Ubuntu/Debian: `sudo apt-get install php-mysql`
  - macOS: `brew install php` (includes PDO)
  - Windows: Enable `extension=pdo_mysql` in `php.ini`
- ✅ Restart web server after installation

---

### **Error: Character set not supported**

```
ERROR 1115 (42000): Unknown character set: 'utf8mb4'
```

**Solutions:**
- ✅ Upgrade MySQL to 5.5.3+ (utf8mb4 introduced in 5.5.3)
- ✅ Or change to `utf8` in database-setup.sql (not recommended)

---

## 📊 DATABASE MAINTENANCE

### **View All Intakes**

```sql
SELECT id, company_name, email, budget, status, submitted_at 
FROM project_intakes 
ORDER BY submitted_at DESC;
```

---

### **Count Intakes by Status**

```sql
SELECT status, COUNT(*) as count 
FROM project_intakes 
GROUP BY status;
```

---

### **Find New Leads (Not Contacted)**

```sql
SELECT company_name, email, budget, submitted_at 
FROM project_intakes 
WHERE status = 'new' 
ORDER BY submitted_at DESC;
```

---

### **Calculate Total Pipeline Value**

```sql
SELECT SUM(estimated_value) as total_pipeline 
FROM project_intakes 
WHERE status IN ('contacted', 'proposal_sent', 'negotiating');
```

---

### **Delete Test Data**

```sql
-- Delete all test submissions
DELETE FROM project_intakes WHERE email LIKE '%test%' OR company_name LIKE '%test%';

-- Or delete specific intake by ID
DELETE FROM project_intakes WHERE id = 1;
```

---

### **Backup Database**

```bash
# Full backup
mysqldump -u rvweb_user -p rv_web_creations > backup-full-$(date +%Y-%m-%d).sql

# Structure only (no data)
mysqldump -u rvweb_user -p --no-data rv_web_creations > backup-structure-$(date +%Y-%m-%d).sql

# Data only (no structure)
mysqldump -u rvweb_user -p --no-create-info rv_web_creations > backup-data-$(date +%Y-%m-%d).sql
```

---

### **Restore from Backup**

```bash
mysql -u rvweb_user -p rv_web_creations < backup-full-2025-11-30.sql
```

---

## 🔄 UPDATING DATABASE SCHEMA

**If you need to add columns or tables in the future:**

### **Method 1: Migration Script (Recommended)**

**Create `migration-001-add-column.sql`:**
```sql
-- Migration: Add referral_code column
-- Date: 2025-12-01
-- Author: RV Web Creations

USE rv_web_creations;

ALTER TABLE project_intakes 
ADD COLUMN referral_code VARCHAR(50) NULL AFTER referral_name;

-- Verify
DESCRIBE project_intakes;
```

**Run migration:**
```bash
mysql -u rvweb_user -p rv_web_creations < migration-001-add-column.sql
```

---

### **Method 2: Direct ALTER (Quick)**

```sql
USE rv_web_creations;

-- Add new column
ALTER TABLE project_intakes 
ADD COLUMN new_column_name VARCHAR(100) NULL;

-- Modify existing column
ALTER TABLE project_intakes 
MODIFY COLUMN budget VARCHAR(100);

-- Drop column (careful!)
ALTER TABLE project_intakes 
DROP COLUMN old_column_name;
```

---

## 📝 DEPLOYMENT CHECKLIST

**Before going live, verify:**

- [ ] Database created successfully
- [ ] All 4 tables exist (intakes, proposals, projects, notes)
- [ ] Database user created with strong password
- [ ] PHP files updated with correct credentials
- [ ] Admin dashboard password changed from default
- [ ] Connection test passes
- [ ] Form submission test works
- [ ] Admin dashboard login works
- [ ] Pricing calculator works
- [ ] Email notifications working
- [ ] Database backups configured
- [ ] .env file created (if using)
- [ ] .env added to .gitignore
- [ ] Test data cleaned up

---

## 🎯 NEXT STEPS

**After database deployment:**

1. **Test all forms:**
   - Submit contact form
   - Submit project intake form
   - Verify email notifications
   - Check database entries

2. **Test admin dashboard:**
   - Log in
   - View submissions
   - Update status
   - Test pricing calculator

3. **Set up backups:**
   - Configure automated daily backups
   - Test restore process
   - Store backups securely (off-site)

4. **Monitor database:**
   - Check disk space regularly
   - Monitor query performance
   - Review error logs
   - Track growth rate

5. **Plan for scale:**
   - Index optimization (already done)
   - Query optimization as data grows
   - Consider read replicas at 10,000+ records
   - Archive old data after 2+ years

---

## 📞 NEED HELP?

**Common hosting providers documentation:**

- **cPanel:** Usually includes phpMyAdmin for easy import
- **Plesk:** Similar GUI database management
- **AWS RDS:** Use MySQL Workbench or command line
- **DigitalOcean:** SSH access, use command line method
- **Heroku:** Use ClearDB addon, deploy via CLI
- **Vercel:** Use PlanetScale or similar MySQL hosting

**MySQL Documentation:**
- Official: https://dev.mysql.com/doc/
- PDO Tutorial: https://www.php.net/manual/en/book.pdo.php

---

**Database deployment complete! Your system is ready to store and manage client data.** 🚀

*Last Updated: November 30, 2025*
