# 🏗️ RV Web Creations - System Architecture Guide

**Complete overview of your business system: what's built, what Moxie handles, and how everything works together.**

---

## 📋 TABLE OF CONTENTS

1. [System Overview](#system-overview)
2. [Custom System Components](#custom-system-components)
3. [Moxie Integration](#moxie-integration)
4. [Complete Workflow](#complete-workflow)
5. [Gap Analysis](#gap-analysis)
6. [Tech Stack](#tech-stack)
7. [Setup Instructions](#setup-instructions)

---

## 🎯 SYSTEM OVERVIEW

### **Architecture Philosophy**

Your business system is split into two complementary parts:

**CUSTOM SYSTEM (Pre-Sale):**
- Lead capture and qualification
- Comprehensive intake data collection
- Intelligent pricing calculation
- Lead management dashboard

**MOXIE (Post-Sale):**
- Proposal generation and delivery
- Contract management and e-signatures
- Invoicing and payment processing
- Client portal and communication
- Project tracking and updates
- Recurring billing for maintenance

**Why This Works:**
- Your custom system handles complex intake forms and pricing logic that Moxie can't do
- Moxie handles the professional client-facing experience and payment processing
- Together they provide complete lead-to-launch-to-maintenance workflow
- No duplication of effort
- Each system does what it's best at

---

## 🔧 CUSTOM SYSTEM COMPONENTS

### **1. Website & Marketing (Public-Facing)**

#### **Core Pages:**
- `src/index.html` - Homepage with hero, services overview, CTA
- `src/services.html` - Detailed service offerings
- `src/pricing.html` - Transparent pricing (Starter $2,500-6k, Growth $7,500-18k+)
- `src/process.html` - How you work (12-phase process)
- `src/portfolio.html` - Case studies and examples
- `src/about.html` - Your story and expertise
- `src/faq.html` - Common questions answered
- `src/contact.html` - Contact form for initial inquiries
- `src/policies.html` - Terms, refund policy, legal

#### **Styling:**
- `src/css/styles.css` - Compiled CSS
- `src/scss/styles.scss` - Source SCSS
- `src/js/main.js` - Interactive features

#### **Purpose:**
- Professional brand presence
- Lead generation
- Set expectations
- Filter qualified prospects
- Build trust

---

### **2. Contact Form (Initial Lead Capture)**

#### **Files:**
- `src/contact.html` - Simple contact form
- `src/contact-handler.php` - Processes submissions, sends email

#### **Fields Collected:**
- Name
- Email
- Company (optional)
- Message

#### **Functionality:**
- ✅ Saves submission to database (if database connected)
- ✅ Sends email notification to info@rvwebcreations.com
- ✅ Server-side validation
- ✅ User-friendly error handling

#### **Use Case:**
- First touch point for prospects
- Quick inquiries
- General questions
- Before they're ready for full intake

---

### **3. Project Intake Form (Comprehensive Data Collection)**

#### **Files:**
- `src/project-intake.html` - 16-section intake form
- `src/intake-handler.php` - Processes submissions, saves to database + email

#### **16 Sections Captured:**
1. **Contact Information** - Name, email, phone, company, website
2. **Business Information** - Industry, years in business, description
3. **Project Type** - New site, redesign, e-commerce, etc.
4. **Website Goals** - Primary objectives and success metrics
5. **Target Audience** - Ideal customer description
6. **Features Needed** - Contact form, blog, e-commerce, booking, etc.
7. **Pages Needed** - Number and types of pages
8. **Design Preferences** - Style, inspiration sites, existing branding
9. **Technical Requirements** - Hosting needs, integrations, CMS preference
10. **Competitors** - Who they compete with, what they like/dislike
11. **Budget** - Realistic ranges ($2,500-6k, $7,500-12k, $12k-18k, $18k+)
12. **Timeline** - When they need to launch, urgency level (1-10)
13. **Content Readiness & Migration** - Content status, existing site, migration needs
14. **Ongoing Support & Maintenance Interest** - Care plan interest, support needs
15. **Payment & Contract Preferences** - Referral source, nonprofit status, payment preference
16. **Additional Notes** - Anything else they want to share

#### **Database Storage:**
- Table: `project_intakes`
- 53 fields stored
- System fields: `id`, `submitted_at`, `ip_address`, `status`
- Tracking fields: `status_notes`, `estimated_value`, `proposal_sent_at`, `followed_up_at`
- Status values: new, contacted, proposal_sent, negotiating, accepted, declined, on_hold

#### **Functionality:**
- ✅ Comprehensive data collection for accurate proposals
- ✅ Saves to database via PDO prepared statements
- ✅ Sends detailed email notification
- ✅ Server-side validation and sanitization
- ✅ Tracks all proposal-critical information
- ✅ Identifies discount eligibility (nonprofit, referral)
- ✅ Captures maintenance plan interest

#### **Use Case:**
- After initial contact/discovery call
- Before creating proposal
- Ensures you have all info needed for accurate pricing
- Reduces back-and-forth questions

---

### **4. Admin Dashboard (Lead Management)**

#### **File:**
- `src/admin-dashboard.php`

#### **Authentication:**
- Simple password protection (session-based)
- Default password: `changeme123` (MUST CHANGE)
- Login screen before access

#### **Features:**

**Statistics Dashboard:**
- Total intakes received
- New leads (not contacted yet)
- Contacted leads
- Proposals sent
- Accepted projects
- Total pipeline value (estimated)

**Filtering & Search:**
- Filter by status (new, contacted, proposal_sent, negotiating, accepted, declined, on_hold)
- Filter by budget range
- Search by company name, email, or contact person
- Sort by date, budget, urgency

**Intake Table View:**
- ID, date submitted, company name
- Contact person and email
- Budget range and timeline
- Current status with color-coded badges
- Visual indicators: Urgent flag, Nonprofit badge, Referral badge

**Actions Per Intake:**
- **Calculate Pricing** button - Opens pricing calculator with intake data
- **View** button - Full intake details in modal (all 16 sections)
- **Edit** button - Update status, add notes, set estimated value

**Status Management:**
- Change status with dropdown
- Add status notes for tracking
- Set estimated project value
- Track follow-up dates

**Email Integration:**
- Click-to-email links for each contact
- Pre-filled subject lines

#### **Use Case:**
- View all incoming leads in one place
- Track lead status through pipeline
- Quick access to all client information
- Jump to pricing calculator
- Manage follow-ups

---

### **5. Pricing Calculator (Intelligent Quote Generator)**

#### **File:**
- `src/pricing-calculator.php`

#### **Smart Auto-Suggestions:**

**Package Recommendation:**
- Analyzes intake budget field
- Suggests appropriate package (Starter, Growth, Growth Advanced, Custom)
- Highlights recommended option

**Add-on Suggestions:**
- Content status → Suggests copywriting services
- Existing website → Suggests migration ($800)
- Features mentioned:
  - "ecommerce"/"shop" → E-commerce add-on ($2k-5k)
  - "booking"/"appointment" → Booking system ($1,500)
  - "member"/"login" → Member portal ($2k)
  - "blog" → Blog setup ($500)
- Timeline urgency ≥8 → Rush delivery (+25-50%)

**Discount Eligibility:**
- Nonprofit status = Yes → 15% discount auto-checked
- Referral name provided → 10% discount auto-checked
- Payment preference = Full upfront → 5% discount auto-checked

#### **Pricing Structure:**

**Base Packages:**
| Package | Price Range | Description |
|---------|-------------|-------------|
| Starter Site | $2,500 - $6,000 | 1-5 pages, basic features, 2-4 weeks |
| Growth Site | $7,500 - $12,000 | 6-15 pages, advanced features, 4-8 weeks |
| Growth Advanced | $12,000 - $18,000 | 16+ pages, complex features, 8-12 weeks |
| Custom/Enterprise | $18,000 - $50,000 | Custom scope, enterprise features, 12+ weeks |

**Add-ons by Category:**

*Content & Copywriting:*
- Basic Copywriting (3-5 pages): $500
- Full Copywriting (6-15 pages): $1,500
- Advanced Copywriting (16+ pages): $3,000
- Content Migration: $800

*E-commerce:*
- Basic (up to 25 products): $2,000
- Standard (26-100 products): $3,500
- Advanced (100+ products): $5,000
- Additional Payment Gateway: $500

*Features & Integrations:*
- Booking/Scheduling System: $1,500
- Member Login/Portal: $2,000
- Custom Forms & Calculators: $800
- Blog Setup & Training: $500
- Email Marketing Integration: $600
- CRM Integration: $1,000
- Custom API Integration: $1,500

*Design & Media:*
- Custom Graphics & Illustrations: $800
- Photography Coordination: $500
- Video Integration: $400

*Advanced Options:*
- Multi-language Support: $2,000
- Advanced SEO Package: $1,200
- WCAG Accessibility: $1,500
- Performance Optimization: $800

*Timeline Adjustments:*
- Rush Delivery (50% faster): +25% of base price
- Urgent Rush (2 weeks or less): +50% of base price

**Discounts:**
- Nonprofit Organization: -15%
- Referral Discount: -10%
- Full Upfront Payment: -5%

**Payment Schedule Options:**
1. **Standard (50/25/25):**
   - 50% deposit at contract signing
   - 25% at project midpoint
   - 25% upon completion

2. **Full Upfront:**
   - 100% at contract signing
   - Includes 5% discount

3. **Milestone-Based:**
   - Equal payments at 2-6 milestones
   - Flexible based on project phases

#### **Calculator Features:**

**Interactive Configuration:**
- Click package cards to select
- Slider to adjust base price within package range
- Checkboxes for add-ons organized by category
- Discount checkboxes
- Payment schedule selector

**Real-Time Calculation:**
- Shows itemized breakdown
- Base price + add-ons = subtotal
- Apply percentage discounts
- Calculate final total
- Generate payment schedule based on selection

**Output:**
- Detailed pricing breakdown
- Line-item listing of all add-ons
- Discount calculations shown
- Payment schedule with amounts and due dates
- Professional format ready for client discussion

**Database Integration:**
- Saves `estimated_value` back to intake record
- Tracks pricing calculations for pipeline reporting

#### **Use Case:**
- After viewing intake in dashboard
- Click "Calculate Pricing" button next to intake
- Calculator opens with intake data pre-loaded
- Adjust as needed based on client discussion
- Generate accurate quote in minutes
- Use pricing to create Moxie proposal

---

### **6. Database Schema**

#### **File:**
- `database-setup.sql` - Complete SQL schema

#### **Tables:**

**Table 1: `project_intakes`** (Primary table)
- 53 columns covering all 16 intake form sections
- Indexes on: email, status, submitted_at, company_name, budget
- Status ENUM: new, contacted, proposal_sent, negotiating, accepted, declined, on_hold
- Tracking fields for proposal, follow-up, and close dates
- Estimated value field for pipeline reporting

**Table 2: `proposals`** (Optional - for future use)
- Links to project_intakes via foreign key
- Proposal details: number, package, pricing breakdown
- Payment schedule: deposit, milestones, final amounts
- Status tracking: draft, sent, viewed, accepted, declined, expired
- File paths for proposal and contract PDFs
- Timestamps for sent, viewed, responded dates

**Table 3: `projects`** (Optional - for future use)
- Links to intakes and proposals
- Active project tracking
- Contract value and payment tracking
- Timeline: start, estimated launch, actual launch
- Milestone completion and payment flags
- Hosting and maintenance plan tracking
- Staging and live URLs
- Time tracking: estimated vs actual hours

**Table 4: `notes`** (Optional - for future use)
- Communication log
- Links to intakes, proposals, or projects
- Note types: email, call, meeting, internal, client_request
- Subject, note text, created by, timestamp

#### **Purpose:**
- Central data store for all client information
- Enables dashboard filtering and searching
- Tracks lead pipeline from inquiry to project
- Optional tables support future expansion
- Foreign keys maintain data integrity

---

## 🎨 MOXIE INTEGRATION

### **What Moxie Handles**

#### **1. Proposals ✅**

**Features:**
- Professional proposal templates
- Client-facing branded proposals
- Online proposal viewing (client portal)
- Proposal acceptance workflow
- Proposal status tracking

**Your Workflow:**
1. Calculate pricing in your custom calculator
2. Log into Moxie
3. Create new proposal
4. Enter calculated pricing and scope
5. Send to client via Moxie
6. Client views in Moxie portal
7. Client accepts/declines in Moxie
8. Automatic notification to you

**Setup Required:**
- Create proposal template in Moxie (1 hour)
- Add your branding (logo, colors)
- Define proposal sections (scope, timeline, pricing, payment terms)

---

#### **2. Contracts & E-Signatures ✅**

**Features:**
- Digital service agreements
- E-signature collection (legally binding)
- Contract templates with merge fields
- Automatic contract sending after proposal acceptance
- Executed contract storage
- Client access to signed contracts

**Your Workflow:**
1. Client accepts proposal in Moxie
2. Moxie automatically sends contract
3. Client reviews contract in portal
4. Client signs digitally (DocuSign-style)
5. You receive notification
6. You countersign if needed
7. Both parties get executed copy

**Setup Required:**
- Create contract template in Moxie (1-2 hours)
- Include: scope, payment terms, timeline, IP rights, cancellation, refund policy reference
- Add signature blocks
- Set up automatic sending

**Contract Should Include:**
- Project scope and deliverables
- Payment schedule (50/25/25)
- Timeline and milestones
- Revision policy (3 rounds included)
- Intellectual property rights
- Cancellation and refund terms (link to your refund policy)
- Liability limitations
- Dispute resolution

---

#### **3. Invoicing ✅**

**Features:**
- Professional invoice templates
- Automatic invoice numbering
- Line-item breakdowns
- Tax calculations (if applicable)
- Invoice status tracking (sent, viewed, paid, overdue)
- Payment reminders
- Receipt generation

**Your Workflow:**
1. Create invoice in Moxie
2. Select client and project
3. Add line items (deposit, milestone payment, final payment)
4. Set due date
5. Moxie sends invoice email to client
6. Client clicks "Pay Invoice" button
7. Payment processed via Stripe
8. Invoice automatically marked paid
9. Both parties receive receipt

**Invoice Types:**
- **Deposit Invoice:** 50% at contract signing
- **Milestone Invoice:** 25% at project midpoint (or custom milestones)
- **Final Invoice:** 25% upon completion
- **Recurring Invoice:** Monthly for care plans ($100-500/month)

**Setup Required:**
- Create invoice template (30 minutes)
- Set up invoice numbering (RV-001, RV-002, etc.)
- Connect Stripe for payment processing
- Define payment terms (due upon receipt, net 7 days, etc.)

---

#### **4. Payment Processing (Stripe Integration) ✅**

**Features:**
- Seamless Stripe integration
- One-click payment from invoice
- Credit/debit card acceptance (all major cards)
- ACH bank transfers (lower fees for large amounts)
- Apple Pay / Google Pay
- Automatic payment confirmation
- Secure payment processing (PCI compliant)
- Payment history tracking

**Client Experience:**
1. Receives invoice email from Moxie
2. Clicks "Pay Invoice" button
3. Redirects to Stripe-powered payment page (Moxie-branded)
4. Enters card info or selects saved card
5. Submits payment
6. Instant confirmation
7. Receives receipt via email

**Your Experience:**
1. Client pays via Stripe
2. Moxie marks invoice as paid
3. You receive payment notification
4. Stripe holds funds 2-3 days
5. Money deposits to your bank account
6. View transaction in Stripe dashboard

**Fees:**
- Credit/Debit Cards: 2.9% + $0.30 per transaction
- ACH Bank Transfer: 0.8% (capped at $5 max)
- Example: $2,500 deposit = $72.80 fee, you receive $2,427.20

**Setup Required:**
- Create Stripe account (30 minutes)
- Verify identity and bank account
- Connect Stripe to Moxie (5 minutes)
- Test with dummy transaction
- Ready to accept payments

**Supported Payment Methods:**
- ✅ Visa, Mastercard, Amex, Discover
- ✅ All major debit cards
- ✅ ACH bank transfers
- ✅ Apple Pay
- ✅ Google Pay
- ✅ International cards (195+ countries)

---

#### **5. Client Portal ✅**

**Features:**
- Client login area (automatic for every client)
- View all proposals
- Sign contracts digitally
- Access invoices and payment history
- Make payments
- View project status and updates
- Download files and deliverables
- Message/comment on projects
- Mobile-friendly

**What Clients See:**
- Dashboard with project overview
- Timeline with milestones
- Outstanding invoices
- Payment history
- Shared files
- Project updates from you
- Contract documents

**Your Benefits:**
- Professional client experience
- Reduced email back-and-forth
- Client can self-serve (view invoices, make payments)
- Centralized communication
- Document sharing in one place

**Setup Required:**
- None - automatic with every Moxie project
- Client receives portal invitation when you send first proposal

---

#### **6. Project Management ✅**

**Features in Moxie:**
- Project dashboard
- Task lists and to-dos
- Milestone tracking
- Time tracking
- File sharing
- Project status updates
- Client notifications

**You're Also Using ClickUp:**
- Internal task management (400+ tasks from your workflow)
- Detailed phase tracking (12 phases)
- Team collaboration (if you expand)
- Advanced project views (Gantt, Calendar, Board)

**Recommended Split:**
- **Moxie:** Client-facing updates, high-level milestones, deliverable tracking
- **ClickUp:** Internal detailed tasks, your personal workflow, checklist execution

**Your Workflow:**
1. Create project in Moxie when contract signed
2. Set up milestones (design approval, content due, launch)
3. Use ClickUp template (your 400+ task checklist)
4. Update Moxie milestones as you complete phases
5. Client sees progress in Moxie portal
6. You manage details in ClickUp

**Setup Required:**
- Moxie: Create project template with standard milestones (1 hour)
- ClickUp: Build template from your `clickup-project-template.md` (2 hours)

---

#### **7. Recurring Billing (Care Plans) ✅**

**Features:**
- Automated recurring invoices
- Subscription management
- Automatic credit card charging
- Payment failure notifications
- Client can update payment method
- Pause/cancel subscription management

**Your Workflow:**
1. Client signs up for care plan ($100-500/month)
2. Create recurring invoice in Moxie
3. Set schedule (monthly on 1st of month)
4. Client saves card in Moxie portal
5. Moxie automatically:
   - Generates invoice each month
   - Charges saved card
   - Sends receipt
   - Notifies you of payment
6. If payment fails:
   - Automatic retry in 3 days
   - Email notification to client
   - You get alert to follow up

**Care Plan Tiers** (from your pricing):
- **Light Care:** $100-125/month - Updates, backups, monitoring
- **Standard Care:** $150-350/month - + Security, SEO, analytics
- **Custom Care:** $500+/month - + Priority support, content updates

**Setup Required:**
- Create recurring invoice template (30 minutes)
- Define care plan packages in Moxie
- Set up automatic card charging
- Create care plan agreement (one-time)

**Alternative:** Can manually send invoices each month if you prefer more control

---

#### **8. Time Tracking & Reporting ✅**

**Features:**
- Track time per project
- Billable vs non-billable hours
- Generate time reports
- Client-visible time logs (optional)
- Export for accounting

**Your Workflow:**
1. Start timer when working on project
2. Add time entry with description
3. Mark as billable or non-billable
4. Review time reports weekly/monthly
5. Compare actual vs estimated hours
6. Improve estimates for future projects

**Use Cases:**
- Track profitability per project
- Identify scope creep
- Improve time estimates
- Bill hourly clients (if you add that)
- Analyze where time goes

---

### **Moxie Pricing**

**Free Plan:**
- Unlimited clients
- Unlimited proposals
- Unlimited invoices
- Basic features
- Stripe integration included

**Paid Plans:** (~$20-40/month)
- Advanced features
- Custom branding
- Automation
- Reporting
- Team members

**Recommendation:** Start with free plan, upgrade when revenue justifies it

---

## 🔄 COMPLETE WORKFLOW

### **Phase 1: Lead Generation**

**Marketing → Website:**
- Client finds your website (SEO, social, referral, ads)
- Reviews services, pricing, process, portfolio
- Reads FAQ and policies
- Gains trust and confidence

**Initial Contact:**
- Client fills out contact form (`contact.html`)
- `contact-handler.php` processes submission
- Saves to database (optional)
- Sends email notification to you
- Client receives confirmation message

**Your Action:**
- Receive email notification
- Review inquiry details
- Respond within 24 hours
- Schedule discovery call (15-30 min)

---

### **Phase 2: Discovery & Qualification**

**Discovery Call:**
- Discuss their business and goals
- Understand target audience
- Clarify must-have features
- Discuss timeline and urgency
- Provide ballpark pricing range
- Explain your process

**Decision Point:**
- If not a fit: Politely decline, offer referrals
- If good fit: Send project intake form link

**Send Intake Form:**
- Email link to `project-intake.html`
- Request completion within 3-5 days
- Explain why you need detailed info

---

### **Phase 3: Intake & Data Collection**

**Client Completes Intake:**
- 16 comprehensive sections
- 30-45 minutes to complete
- Submitted via `project-intake.html`

**Form Processing:**
- `intake-handler.php` receives submission
- Validates and sanitizes all input
- Saves to `project_intakes` database table (53 fields)
- Sends detailed email to you with all information
- Client receives confirmation message

**Database Record Created:**
- Status: "new"
- All 16 sections stored
- Timestamp recorded
- Ready for your review

---

### **Phase 4: Pricing Calculation**

**Access Admin Dashboard:**
- Navigate to `admin-dashboard.php`
- Log in with password
- View intake in dashboard table
- See new lead with "New" status badge

**Open Pricing Calculator:**
- Click green calculator icon next to intake
- Calculator opens: `pricing-calculator.php?intake_id=123`
- Intake data automatically loaded

**Smart Suggestions:**
- Package recommended based on budget
- Add-ons suggested based on needs:
  - Content migration (if existing site)
  - Copywriting (if content help needed)
  - E-commerce (if shopping mentioned)
  - Booking system (if appointments mentioned)
  - Rush delivery (if urgency ≥8)
- Discounts auto-checked if eligible:
  - Nonprofit (15% off)
  - Referral (10% off)
  - Upfront payment (5% off)

**Review & Adjust:**
- Review suggested package (Starter/Growth/Growth Advanced/Custom)
- Adjust base price with slider
- Toggle add-ons on/off as needed
- Apply appropriate discounts
- Select payment schedule (50/25/25, upfront, milestone)

**Calculate:**
- Click "Calculate Pricing" button
- See detailed breakdown:
  - Base package: $X,XXX
  - Add-ons: $X,XXX (itemized)
  - Subtotal: $X,XXX
  - Discounts: -$XXX (itemized)
  - **Final Total: $X,XXX**
- View payment schedule:
  - Deposit: $X,XXX (at signing)
  - Milestone: $X,XXX (at midpoint)
  - Final: $X,XXX (at completion)

**Save Estimate:**
- Estimated value saved to intake record
- Updates pipeline value in dashboard

**Use Case Example:**
```
Client: Local gym wants new website
Budget: $7,500-$12,000
Features: 10 pages, booking system, blog

Calculator suggests:
- Base: Growth Site ($9,000)
- Add-ons:
  - Booking System: $1,500
  - Blog Setup: $500
- Subtotal: $11,000
- Discount: Referral -10% (-$1,100)
- Final: $9,900

Payment Schedule (50/25/25):
- Deposit: $4,950
- Midpoint: $2,475
- Final: $2,475
```

---

### **Phase 5: Proposal Creation (Switch to Moxie)**

**Create Proposal in Moxie:**
- Log into Moxie account
- Click "New Proposal"
- Select client (or create new)
- Use proposal template

**Enter Calculated Pricing:**
- Copy pricing breakdown from calculator
- Enter into Moxie proposal:
  - Project overview (from intake goals)
  - Scope of work (from intake features)
  - Timeline (from intake timeline)
  - Base package + add-ons (from calculator)
  - Discount explanation (from calculator)
  - Final total (from calculator)
  - Payment schedule (from calculator)

**Additional Proposal Sections:**
- What's included vs excluded
- Your process (12 phases)
- Revision policy (3 rounds included)
- Client responsibilities (content, images, etc.)
- Next steps (sign contract, pay deposit)
- Terms reference (link to policies)

**Send Proposal:**
- Click "Send Proposal" in Moxie
- Moxie emails client with link
- Client receives professional branded proposal
- You receive notification it was sent

---

### **Phase 6: Proposal Review & Acceptance**

**Client Reviews:**
- Client receives email with proposal link
- Clicks link to view in Moxie portal
- Reviews scope, pricing, timeline
- Can ask questions via Moxie comments or email you

**Your Response:**
- Answer questions promptly
- Schedule call if needed to discuss
- Adjust proposal if necessary
- Resend updated version

**Client Accepts:**
- Client clicks "Accept Proposal" in Moxie portal
- Automatic notification sent to you
- Moxie triggers contract workflow

**Update Dashboard:**
- Go to your admin dashboard
- Change intake status to "proposal_sent" → "accepted"
- Add status note if needed

---

### **Phase 7: Contract Signing**

**Automatic Contract Send:**
- Moxie automatically sends contract after proposal acceptance
- Client receives email with contract link
- Contract includes all proposal terms

**Client Signs:**
- Client reviews contract in Moxie portal
- E-signature process (click to sign)
- Legally binding digital signature
- Date and IP address recorded

**You Countersign:**
- Receive notification of client signature
- Review contract in Moxie
- Add your signature
- Moxie marks contract as fully executed

**Both Receive Copies:**
- Moxie sends executed contract PDF to both parties
- Stored in Moxie portal
- Client can download anytime

---

### **Phase 8: Deposit Payment**

**Create Deposit Invoice:**
- Create new invoice in Moxie
- Link to project
- Line item: "50% Project Deposit"
- Amount: $X,XXX (from payment schedule)
- Due date: Upon receipt
- Stripe payment enabled

**Send Invoice:**
- Moxie sends invoice email to client
- Email includes "Pay Invoice" button
- Professional branded invoice PDF attached

**Client Pays:**
- Client clicks "Pay Invoice"
- Redirects to Stripe payment page (Moxie-branded)
- Enters credit card or ACH bank account
- Submits payment
- Receives instant confirmation and receipt

**Payment Confirmation:**
- Moxie automatically marks invoice as paid
- You receive payment notification
- Stripe processes payment
- Money appears in bank 2-3 days later
- Both parties have receipt

**Start Work:**
- Confirm payment received
- Update intake status to "on_hold" or create active project
- Send welcome email
- Schedule kickoff call

---

### **Phase 9: Project Kickoff (Using ClickUp + Moxie)**

**Setup Project Management:**

**In Moxie:**
- Create new project
- Link to proposal and contract
- Set up milestones:
  1. Discovery & Planning (Week 1-2)
  2. Design (Week 3-4)
  3. Development (Week 5-6)
  4. Content & Testing (Week 7)
  5. Launch (Week 8)
- Invite client to project portal
- Share project timeline

**In ClickUp:**
- Create project from your template
- Load 400+ task checklist (12 phases)
- Assign yourself to all tasks
- Set due dates based on timeline
- Start Phase 1 tasks

**Client Onboarding:**
- Send welcome email with:
  - Moxie portal login details
  - Next steps and timeline
  - What you need from them (content, images, etc.)
  - Communication expectations
  - Your contact info

**Kickoff Call:**
- Review project scope
- Discuss brand guidelines (colors, fonts, style)
- Show design inspiration examples
- Clarify target audience
- Review content needs
- Confirm timeline
- Answer questions

---

### **Phase 10: Project Execution**

**Your Workflow:**

**Week 1-2: Discovery & Planning**
- Gather content from client (via Moxie file sharing)
- Research competitors
- Create sitemap
- Plan page layouts
- Define technical requirements
- Check off ClickUp tasks in Phase 3

**Week 3-4: Design**
- Create design mockups (Figma/Adobe XD)
- Share with client (upload to Moxie)
- Client reviews in Moxie portal
- Client provides feedback via Moxie comments
- Revise design (up to 3 rounds included)
- Get design approval
- Check off ClickUp tasks in Phase 4

**Week 5-6: Development**
- Build HTML/CSS/JS
- Implement functionality
- Add content
- Set up integrations
- Responsive testing
- Check off ClickUp tasks in Phase 5-7

**Week 7: Content & Testing**
- Final content edits
- Browser testing
- Device testing
- Performance optimization
- Accessibility check
- Client review on staging site
- Check off ClickUp tasks in Phase 8-9

**Milestone Payment:**
- Create milestone invoice in Moxie (25%)
- Send to client
- Client pays via Stripe
- Continue to final phase

**Week 8: Launch Prep**
- Final client approval
- Create backup
- Deploy to live server
- DNS/domain setup
- SSL certificate
- Final testing on live site
- Check off ClickUp tasks in Phase 10

---

### **Phase 11: Launch & Final Payment**

**Launch:**
- Take site live
- Verify everything works
- Send launch announcement to client
- Update Moxie project status to "Completed"

**Client Training:**
- Screen recording of how to update site
- Documentation for CMS (if applicable)
- Share via Moxie

**Final Invoice:**
- Create final invoice in Moxie (25%)
- Line item: "Final Payment - Project Completion"
- Send to client
- Client pays via Stripe

**Project Closeout:**
- Send thank you email
- Request testimonial/review
- Ask for referrals
- Provide care plan options
- Update dashboard status to "closed"
- Archive project files

---

### **Phase 12: Ongoing Maintenance (Optional)**

**Care Plan Setup:**
- Client chooses plan (Light $100-125, Standard $150-350, Custom $500+)
- Create care plan agreement in Moxie
- Client signs agreement

**Recurring Billing Setup:**
- Create recurring invoice in Moxie
- Schedule: Monthly on 1st of month
- Line items:
  - Website updates
  - Security monitoring
  - Backups
  - Support hours (if applicable)
- Enable automatic card charging
- Client saves card on file

**Automatic Monthly Billing:**
- Moxie generates invoice on 1st of month
- Automatically charges saved card
- Sends receipt to client
- Notifies you of payment
- Money deposits to bank 2-3 days later

**Provide Care Services:**
- Monitor site monthly
- Apply updates
- Security scans
- Backups
- Performance checks
- Handle support requests
- Track time in Moxie
- Check off ClickUp maintenance tasks

**If Payment Fails:**
- Moxie sends notification to client
- Automatic retry in 3 days
- You receive alert
- Follow up with client
- Pause services if needed

---

## 📊 GAP ANALYSIS

### **What You Have Built ✅**

| Component | Status | Completeness |
|-----------|--------|--------------|
| Professional Website | ✅ Complete | 100% |
| Contact Form | ✅ Complete | 100% |
| Project Intake Form (16 sections) | ✅ Complete | 100% |
| Database Schema | ✅ Complete | 100% |
| Admin Dashboard | ✅ Complete | 100% |
| Pricing Calculator | ✅ Complete | 100% |
| Documentation (workflows, policies) | ✅ Complete | 100% |

### **What Moxie Provides ✅**

| Component | Moxie Handles | Setup Required |
|-----------|---------------|----------------|
| Proposals | ✅ Yes | 1 hour template |
| Contracts | ✅ Yes | 1-2 hours template |
| E-Signatures | ✅ Yes | Automatic |
| Invoicing | ✅ Yes | 30 min template |
| Payment Processing | ✅ Yes (Stripe) | 30 min Stripe setup |
| Client Portal | ✅ Yes | Automatic |
| Project Management | ✅ Yes | 1 hour template |
| Recurring Billing | ✅ Yes | 30 min template |
| Time Tracking | ✅ Yes | Immediate use |
| Document Sharing | ✅ Yes | Immediate use |

### **What You Don't Need to Build ❌**

- ❌ PDF proposal generator (Moxie does this)
- ❌ Contract management system (Moxie does this)
- ❌ E-signature collection (Moxie does this)
- ❌ Invoice generator (Moxie does this)
- ❌ Payment tracking (Moxie + Stripe do this)
- ❌ Client portal (Moxie does this)
- ❌ File sharing system (Moxie does this)
- ❌ Recurring payment system (Moxie does this)

### **Your System Completion: 95% ✅**

**Pre-Sale (Your Custom System):** 100% Complete
- ✅ Lead capture
- ✅ Intake data collection
- ✅ Lead management
- ✅ Pricing calculation

**Post-Sale (Moxie):** 0% Setup (but fully capable)
- ⏳ Proposals (need template)
- ⏳ Contracts (need template)
- ⏳ Invoicing (need template)
- ⏳ Project tracking (need template)
- ⏳ Stripe connection (need setup)

**Overall:** You have everything you need, just need to set up Moxie when first client is ready (4-5 hours total setup time).

---

## 💻 TECH STACK

### **Frontend (Website)**
- **HTML5** - Semantic markup
- **CSS3** - Modern styling
- **SCSS** - CSS preprocessing
- **JavaScript (ES6+)** - Interactive features
- **Bootstrap 5** - Responsive framework (admin dashboard)

### **Backend**
- **PHP 8+** - Server-side processing
- **MySQL 8+** - Database
- **PDO** - Database connection (prepared statements for security)

### **Admin Interface**
- **Bootstrap 5** - UI framework
- **Vanilla JavaScript** - Admin interactions

### **External Services**
- **Moxie** - Proposals, contracts, invoicing, client portal
- **Stripe** - Payment processing
- **ClickUp** - Project management (internal)
- **Wave** - Accounting (optional)

### **Development Tools**
- **Git** - Version control
- **VS Code** - Code editor (recommended)
- **SCSS Compiler** - For CSS preprocessing

### **Hosting Requirements**
- **Web Server** - Apache or Nginx
- **PHP 8+** - Required
- **MySQL 8+** - Required
- **SSL Certificate** - Required (HTTPS)
- **Email** - SMTP or server email for form notifications

---

## 🚀 SETUP INSTRUCTIONS

### **Phase 1: Website & Database (Now)**

#### **1. Set Up Database**

**Create Database:**
```bash
mysql -u root -p
CREATE DATABASE rv_web_creations CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Run Schema:**
```bash
mysql -u root -p rv_web_creations < database-setup.sql
```

**Verify:**
```sql
USE rv_web_creations;
SHOW TABLES;
-- Should see: project_intakes, proposals, projects, notes
```

#### **2. Configure Database Credentials**

**Update Files:**
- `src/contact-handler.php`
- `src/intake-handler.php`
- `src/admin-dashboard.php`
- `src/pricing-calculator.php`

**Change These Lines:**
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'rv_web_creations');
define('DB_USER', 'your_username');     // ← Change this
define('DB_PASS', 'your_password');     // ← Change this
```

#### **3. Change Admin Password**

**Edit `src/admin-dashboard.php` line 13:**
```php
$ADMIN_PASSWORD = 'changeme123';  // ← Change this to secure password
```

#### **4. Update Email Address**

**In All PHP Files:**
```php
$to = "info@rvwebcreations.com";  // ← Change to your email
```

#### **5. Test Forms**

**Contact Form:**
- Navigate to `contact.html`
- Fill out form
- Submit
- Check: Email received? Database entry created?

**Intake Form:**
- Navigate to `project-intake.html`
- Fill out all 16 sections
- Submit
- Check: Email received? Database entry created?

**Admin Dashboard:**
- Navigate to `admin-dashboard.php`
- Log in with your password
- Verify: Can you see intake submissions?

**Pricing Calculator:**
- From dashboard, click calculator icon
- Verify: Intake data loads? Pricing calculates?

#### **6. Deploy Website**

**Upload Files:**
- Upload entire `src/` folder to web server
- Ensure `.htaccess` is configured (if using Apache)
- Set file permissions (755 for directories, 644 for files)

**Test Live:**
- Visit your domain
- Test all pages
- Test forms
- Check SSL certificate

---

### **Phase 2: Moxie Setup (When First Client Ready)**

**Time Required: 4-5 hours total**

#### **1. Create Moxie Account (30 min)**

**Sign Up:**
- Go to hellomoxie.com
- Create account (free plan to start)
- Complete business profile:
  - Business name: RV Web Creations
  - Your name
  - Email: info@rvwebcreations.com
  - Phone number
  - Business address
  - Logo upload
  - Brand colors (#1f4f7b, #f8b400)

#### **2. Connect Stripe (30 min)**

**Create Stripe Account:**
- Go to stripe.com
- Sign up for account
- Business type: Sole proprietor or LLC
- Business name: RV Web Creations
- Tax ID: Your SSN or EIN
- Connect bank account
- Verify identity (may take 1-2 days)

**Connect to Moxie:**
- In Moxie: Settings → Payments
- Click "Connect Stripe"
- Log into Stripe
- Authorize connection
- Test with $1 invoice

#### **3. Create Proposal Template (1 hour)**

**Go to: Templates → Proposals → New Template**

**Sections to Include:**
1. **Cover Page:**
   - Client name
   - Project title
   - Date
   - Your logo

2. **Introduction:**
   - Thank you for opportunity
   - Brief recap of what they need
   - Your understanding of their goals

3. **Project Overview:**
   - Summary of project
   - Key objectives
   - Success metrics

4. **Scope of Work:**
   - Deliverables list
   - Features included
   - Number of pages
   - Integrations
   - What's NOT included

5. **Process:**
   - Your 12-phase process
   - Timeline estimate
   - Client responsibilities
   - Communication plan

6. **Investment:**
   - Base package name and price
   - Add-ons (if any)
   - Discounts (if any)
   - Total project cost
   - Payment schedule (50/25/25)

7. **Timeline:**
   - Estimated start date
   - Key milestones
   - Estimated launch date

8. **Next Steps:**
   - Accept proposal
   - Sign contract
   - Pay deposit
   - Schedule kickoff

9. **Terms:**
   - Revision policy
   - Link to full Terms & Conditions
   - Link to Refund Policy

**Save Template**

#### **4. Create Contract Template (1-2 hours)**

**Go to: Templates → Contracts → New Template**

**Sections to Include:**

**1. Parties:**
- Client name and address
- Your business name and address

**2. Services:**
- Detailed scope from proposal
- Deliverables list
- Timeline

**3. Payment Terms:**
- Total project cost
- Payment schedule (50% / 25% / 25%)
- Due dates
- Accepted payment methods
- Late payment terms (interest if applicable)

**4. Client Responsibilities:**
- Provide content by X date
- Provide images/assets
- Timely feedback (within 3 business days)
- Final approval sign-off

**5. Revision Policy:**
- 3 rounds of revisions included
- Additional revisions: $150/hour
- Major scope changes require new proposal

**6. Timeline:**
- Estimated completion: X weeks
- Delays due to client = timeline extension
- Delays due to you = timeline adjustment

**7. Intellectual Property:**
- Work becomes client's upon final payment
- You retain right to portfolio use
- Third-party tools (licenses remain with vendors)

**8. Cancellation:**
- Client can cancel anytime
- Refund policy: See [link to refund policy]
- Work completed to date is non-refundable

**9. Liability:**
- Limited to amount paid
- No guarantee of specific results (traffic, sales, etc.)
- Client responsible for content legality

**10. Dispute Resolution:**
- Good faith negotiation first
- Mediation if needed
- Jurisdiction (your state)

**11. Signatures:**
- Client signature block
- Your signature block
- Date fields

**Save Template**

#### **5. Create Invoice Template (30 min)**

**Go to: Templates → Invoices → New Template**

**Settings:**
- Invoice prefix: "RV-"
- Starting number: 001
- Due date: Upon receipt (or Net 7)
- Payment terms text
- Late fee (if applicable): 1.5% per month

**Design:**
- Logo at top
- Your business info
- Client info
- Invoice number and date
- Line items table
- Subtotal
- Tax (if applicable)
- Total
- Payment instructions
- "Pay Now" button (Stripe)

**Save Template**

#### **6. Create Recurring Invoice Template (30 min)**

**For Monthly Care Plans:**

**Go to: Templates → Invoices → New Template (Recurring)**

**Settings:**
- Name: "Monthly Care Plan"
- Frequency: Monthly
- Bill on: 1st of month
- Auto-charge: Yes (if card on file)

**Line Items:**
- Care plan tier (Light/Standard/Custom)
- Included services description
- Monthly price

**Save Template**

#### **7. Create Project Template (1 hour)**

**Go to: Templates → Projects → New Template**

**Name:** "Website Project"

**Milestones:**
1. **Discovery & Planning** (Week 1-2)
   - Kickoff call
   - Content gathering
   - Sitemap approval

2. **Design** (Week 3-4)
   - Mockup creation
   - Design revisions
   - Final design approval
   - **Trigger: Send milestone invoice (25%)**

3. **Development** (Week 5-6)
   - Build pages
   - Add content
   - Functionality implementation

4. **Testing & Launch Prep** (Week 7)
   - Client review on staging
   - Testing
   - Final revisions

5. **Launch** (Week 8)
   - Deploy live
   - Client training
   - Project completion
   - **Trigger: Send final invoice (25%)**

**Save Template**

---

### **Phase 3: First Project Test (1 hour)**

#### **Run Complete Test:**

**1. Create Test Client:**
- Name: Test Client
- Email: your-test-email@gmail.com
- Project: Test Website

**2. Create & Send Proposal:**
- Use your template
- Fill in test pricing ($5,000)
- Send to test email

**3. Accept Proposal:**
- Check test email
- Click proposal link
- Review in Moxie portal
- Click "Accept"

**4. Sign Contract:**
- Moxie should auto-send contract
- Check test email
- Click contract link
- Sign digitally

**5. Create & Pay Deposit Invoice:**
- Create invoice in Moxie ($2,500)
- Send to test email
- Click "Pay Invoice"
- Use Stripe test card: 4242 4242 4242 4242
- Verify payment succeeds

**6. Create Project:**
- Create project from template
- Verify milestones appear
- Verify client can see in portal

**7. Complete Test:**
- Send milestone invoice (test payment)
- Update project status
- Send final invoice (test payment)
- Mark project complete

**If Everything Works:**
- ✅ You're ready for real clients!
- Delete test client data
- You now have full workflow operational

---

### **Phase 4: ClickUp Setup (2 hours)**

**1. Create ClickUp Account:**
- Go to clickup.com
- Sign up (free plan)
- Create workspace: "RV Web Creations"

**2. Build Project Template:**
- Reference: `clickup-project-template.md` (400+ tasks)
- Create 12 phases:
  1. Lead & Discovery
  2. Proposal & Contract
  3. Content Gathering & Planning
  4. Sitemap & Structure
  5. Design
  6. Content Creation
  7. Development
  8. Testing & QA
  9. Client Review
  10. Pre-Launch
  11. Launch
  12. Post-Launch & Handoff

**3. Add All Tasks:**
- Copy tasks from your workflow document
- Add to appropriate phases
- Set task templates
- Add checklist items

**4. Configure Custom Fields:**
- Client Name (text)
- Project Type (dropdown)
- Budget (number)
- Launch Date (date)
- Care Plan (checkbox)

**5. Set Up Views:**
- List view (default)
- Board view (Kanban)
- Calendar view (timeline)
- Gantt view (schedule)

**6. Save as Template:**
- Name: "Website Project Template"
- Use for every new project

---

## 📈 SYSTEM PERFORMANCE METRICS

### **Track These KPIs:**

**Lead Metrics:**
- Website visitors per month
- Contact form submissions
- Conversion rate (visitor → contact)
- Intake form completions
- Intake completion rate

**Sales Metrics:**
- Proposals sent per month
- Proposal acceptance rate
- Average project value
- Time from intake to proposal
- Time from proposal to close
- Pipeline value (total estimated value of active leads)

**Project Metrics:**
- Projects in progress
- Average project duration
- On-time completion rate
- Client satisfaction score
- Revision rounds used

**Financial Metrics:**
- Monthly revenue
- Average project profit margin
- Payment collection rate
- Outstanding invoices
- Care plan MRR (monthly recurring revenue)

**Use Your Dashboard:**
- Track lead pipeline value
- Monitor conversion rates
- Identify bottlenecks
- Improve over time

---

## 🎯 NEXT STEPS

### **Immediate (Before Launch):**
- [ ] Set up database
- [ ] Update database credentials in all PHP files
- [ ] Change admin dashboard password
- [ ] Update email addresses
- [ ] Test contact form
- [ ] Test intake form
- [ ] Test admin dashboard
- [ ] Test pricing calculator
- [ ] Deploy website to hosting

### **When First Client Ready (4-5 hours):**
- [ ] Create Moxie account
- [ ] Connect Stripe to Moxie
- [ ] Create proposal template in Moxie
- [ ] Create contract template in Moxie
- [ ] Create invoice template in Moxie
- [ ] Create recurring invoice template in Moxie
- [ ] Create project template in Moxie
- [ ] Run complete test workflow

### **Optional (First 30 Days):**
- [ ] Set up ClickUp project template
- [ ] Create Wave accounting account
- [ ] Set up Google Analytics
- [ ] Configure backup system
- [ ] Create email templates for common responses
- [ ] Build proposal library (save past proposals as templates)

---

## 📚 REFERENCE DOCUMENTS

**Your Project Documentation:**
- `client-project-workflow.md` - Complete 12-phase workflow (400+ tasks)
- `payment-processing-guide.md` - Payment setup and processing (Stripe, ACH, etc.)
- `pricing-calculator-spreadsheet-guide.md` - Pricing structure and calculations
- `clickup-project-template.md` - ClickUp task template
- `legal-policies-guide.txt` - Legal policies and terms
- `site-audit-launch-readiness.md` - Pre-launch checklist

**Your System Files:**
- `database-setup.sql` - Database schema
- `src/admin-dashboard.php` - Lead management
- `src/pricing-calculator.php` - Pricing calculator
- `src/project-intake.html` - Intake form
- `src/intake-handler.php` - Intake processor

---

## 💡 TIPS FOR SUCCESS

### **Best Practices:**

1. **Respond Fast:** Reply to leads within 24 hours
2. **Be Thorough:** Use the full intake form - better data = better proposals
3. **Use Calculator:** Always calculate pricing before creating proposal
4. **Track Everything:** Update dashboard status as leads progress
5. **Stay Organized:** Use ClickUp for tasks, Moxie for client-facing
6. **Communicate Often:** Weekly updates keep clients happy
7. **Set Boundaries:** 3 revision rounds, 3-day response expectations
8. **Collect Testimonials:** After every successful project
9. **Refine Pricing:** Track actual time vs estimated, adjust rates
10. **Scale Gradually:** Perfect the system with 5 clients before expanding

### **Common Pitfalls to Avoid:**

- ❌ Skipping intake form (leads to scope creep)
- ❌ Not using calculator (leads to underpricing)
- ❌ Verbal agreements (always get contract signed)
- ❌ Starting before deposit (always get 50% first)
- ❌ Unlimited revisions (stick to 3 rounds)
- ❌ Poor communication (update clients regularly)
- ❌ Scope creep (document everything, charge for extras)
- ❌ Undercharging (your pricing is fair, stick to it)

---

## 🎉 YOU'RE READY!

Your system is **95% complete**. The only missing piece is setting up Moxie, which takes 4-5 hours and should be done when you have your first real client ready.

**What You Have:**
✅ Professional website that builds trust  
✅ Contact form to capture initial leads  
✅ Comprehensive 16-section intake form  
✅ Database to store all client data  
✅ Admin dashboard to manage your pipeline  
✅ Intelligent pricing calculator with auto-suggestions  
✅ Complete workflow documentation  
✅ All policies and legal documents  

**What Moxie Provides:**
✅ Proposals (professional, branded)  
✅ Contracts (e-signatures, legally binding)  
✅ Invoicing (automated, Stripe-powered)  
✅ Client Portal (professional experience)  
✅ Project Management (client-facing)  
✅ Recurring Billing (care plans)  

**Your Workflow:**
```
Lead → Contact Form → Intake Form → Dashboard → 
Pricing Calculator → [SWITCH TO MOXIE] → Proposal → 
Contract → Payment → Project → Launch → Care Plan
```

**You have everything you need to run a professional, profitable web design business from day one!** 🚀

---

*Last Updated: November 30, 2025*  
*System Version: 1.0*  
*Completion Status: 95% (Moxie setup pending)*
