# 💳 Payment Processing Guide for RV Web Creations

**Complete guide to accepting payments, managing invoices, and handling client transactions.**

---

## 🎯 RECOMMENDED PAYMENT SETUP

### **Primary Payment Processor: Stripe** ⭐

**Why Stripe:**
- Industry standard for modern businesses
- Lowest fees: 2.9% + $0.30 per transaction
- Seamlessly integrates with Moxie
- Accepts all major credit/debit cards
- Built-in ACH bank transfers
- Automatic receipts and invoicing
- Handles recurring payments (care plans)
- Bank deposits in 2-3 days
- No monthly fees (pay per transaction only)

**What Stripe Accepts:**
- ✅ All major credit cards (Visa, Mastercard, Amex, Discover)
- ✅ All major debit cards
- ✅ ACH bank transfers (direct from bank account)
- ✅ Apple Pay
- ✅ Google Pay
- ✅ International cards from 195+ countries

**Setup Process:**
1. Go to stripe.com and create account (5 minutes)
2. Connect to Moxie (built-in integration)
3. Test with fake invoice
4. Ready to accept payments!

**Account Requirements:**
- Business name: RV Web Creations
- Tax ID: Your SSN or EIN
- Bank account for deposits
- Business address

---

## 💰 ALL PAYMENT METHODS COMPARISON

### 🟢 **Credit/Debit Cards via Stripe** (PRIMARY - RECOMMENDED)

**Processing:**
- Fee: 2.9% + $0.30 per transaction
- Processing time: Instant for client
- Deposit time: 2-3 business days to your bank
- Availability: 24/7 online payment

**Client Experience:**
1. Receives invoice email from Moxie
2. Clicks "Pay Invoice" button
3. Enters card information (or uses saved card)
4. Receives instant confirmation
5. Gets receipt via email

**Your Experience:**
1. Send invoice via Moxie
2. Get notification when paid
3. Money appears in bank 2-3 days later
4. Automatic record in Stripe dashboard

**Pros:**
- ✅ Instant payment confirmation
- ✅ Professional and convenient
- ✅ Clients strongly prefer cards (highest adoption)
- ✅ Automatic invoicing and receipts
- ✅ Built into Moxie workflow
- ✅ Secure (Stripe handles all card data/PCI compliance)
- ✅ Works for recurring care plan payments
- ✅ Client can save card for future payments
- ✅ Automatic retry for failed recurring payments

**Cons:**
- ❌ 2.9% processing fee
- ❌ Occasional chargebacks (very rare, ~0.1%)
- ❌ 2-3 day wait for funds

**Best For:**
- 95% of your clients
- All project deposits
- All final payments
- Monthly care plans (auto-charge)
- Urgent payments

**Fee Examples:**
- $2,500 project: $72.80 fee → You receive $2,427.20
- $200 care plan: $6.10 fee → You receive $193.90
- $10,000 project: $290.30 fee → You receive $9,709.70

---

### 🟢 **ACH Bank Transfer via Stripe** (SECONDARY - FOR LARGE AMOUNTS)

**Processing:**
- Fee: 0.8% (capped at $5 maximum)
- Processing time: 5-7 business days
- Availability: US bank accounts only

**How It Works:**
1. Client selects "Pay by Bank Account" on Stripe invoice
2. Enters bank routing and account number
3. Stripe verifies account (instant micro-deposits)
4. Payment processes over 5-7 days
5. Money arrives in your bank

**Pros:**
- ✅ Much lower fees than cards (0.8% vs 2.9%)
- ✅ $5 maximum fee (great for large amounts)
- ✅ Can't "bounce" like checks
- ✅ More secure than checks
- ✅ Good for corporate clients
- ✅ Still automated through Stripe

**Cons:**
- ❌ Takes 5-7 days to process
- ❌ Requires client bank account setup
- ❌ Less convenient than cards
- ❌ Some clients uncomfortable sharing bank info

**Best For:**
- Large projects ($10,000+)
- Corporate clients
- Clients who want to avoid card fees
- When saving on fees matters

**Fee Examples:**
- $10,000 project: $5 fee → You receive $9,995
- $5,000 project: $5 fee → You receive $4,995
- $2,500 project: $5 fee → You receive $2,495

**Note:** ACH is built into Stripe - no separate setup needed. Client simply chooses ACH option when paying invoice.

---

### 🟡 **PayPal** (OPTIONAL - ALTERNATIVE)

**Processing:**
- Fee: 2.99% + $0.49 per transaction
- Processing time: Instant
- Deposit time: Instant to PayPal balance (1 day to bank)

**How It Works:**
1. Send PayPal invoice from paypal.com
2. Client pays via PayPal account or card through PayPal
3. Money appears in PayPal balance instantly
4. Transfer to bank (1 business day)

**Pros:**
- ✅ Widely recognized and trusted brand
- ✅ Instant payment notification
- ✅ Easy international payments
- ✅ Buyer/seller protection
- ✅ Some older clients prefer PayPal
- ✅ Works without Moxie if needed

**Cons:**
- ❌ Slightly higher fees than Stripe (2.99% vs 2.9%)
- ❌ Separate system from Moxie (manual invoicing)
- ❌ Some clients dislike PayPal
- ❌ Can freeze accounts without warning (rare but happens)
- ❌ Extra step to transfer to bank
- ❌ More complex dispute process

**Best For:**
- International clients (better global coverage)
- Clients who specifically request PayPal
- Older clients familiar with PayPal
- Backup option if Stripe has issues

**Setup:**
1. Create PayPal Business account
2. Connect bank account
3. Use paypal.com/invoice to send invoices
4. Or share your PayPal email for direct payment

**Note:** You don't need to set this up unless clients ask for it. Can add in 10 minutes if needed.

---

### 🟡 **Paper Check** (RARE - OLD SCHOOL)

**Processing:**
- Fee: $0 (no processing fees)
- Processing time: Mail time (3-7 days) + clearing time (3-5 days)
- Total time: 6-12 days

**How It Works:**
1. Client writes check
2. Mails to your business address
3. You receive check in mail
4. Deposit via mobile app or at bank
5. Check clears in 3-5 days

**Pros:**
- ✅ No processing fees (you keep 100%)
- ✅ Older/traditional businesses prefer checks
- ✅ Paper trail
- ✅ Good for very large amounts ($20k+) to save on fees

**Cons:**
- ❌ Very slow (7-14 days total)
- ❌ Can bounce (insufficient funds)
- ❌ Requires trip to bank (unless mobile deposit)
- ❌ Not convenient for recurring payments
- ❌ Feels outdated to many clients
- ❌ Risk of check getting lost in mail
- ❌ Harder to track and reconcile

**Best For:**
- Clients over 65 who refuse cards
- Government contracts (often require checks)
- Very large corporations with strict payment policies
- One-time accommodation for good clients

**What to Include on Invoice:**
```
CHECK PAYMENTS:
Make check payable to: RV Web Creations
Mail to: [Your business address]

Please include invoice number on check memo line.
```

**Reality Check:**
- Expect 1-2 check requests per year maximum
- Most clients under 60 won't even suggest checks
- You can politely decline and guide to Stripe ACH

---

### 🟡 **Wire Transfer** (RARE - LARGE PROJECTS ONLY)

**Processing:**
- Fee: $15-50 per wire (usually client pays)
- Processing time: Same day (domestic) or 1-3 days (international)

**How It Works:**
1. Provide bank routing/account number to client
2. Client initiates wire at their bank
3. Bank-to-bank transfer
4. Money appears same day
5. Bank notifies you of incoming wire

**Pros:**
- ✅ Very fast (same-day domestic)
- ✅ Secure and irreversible (can't be cancelled/charged back)
- ✅ Good for very large amounts ($20,000+)
- ✅ Works for international clients
- ✅ No percentage fee (flat fee regardless of amount)

**Cons:**
- ❌ Expensive ($25-50 per transaction)
- ❌ Requires manual setup each time
- ❌ Client's bank charges them fee too
- ❌ Overkill for typical projects
- ❌ More complicated process

**Best For:**
- Projects over $20,000 (fee becomes negligible)
- International clients (faster than international ACH)
- Rush situations (need money same-day)
- Corporate clients who prefer wires

**Information to Provide Client:**
```
WIRE TRANSFER DETAILS:
Bank Name: [Your bank]
Routing Number: [9-digit routing]
Account Number: [Your account]
Account Name: RV Web Creations
SWIFT Code: [If international]

Reference: Invoice #[number]
```

**Reality Check:**
- You'll probably never need this for typical $2.5k-$15k projects
- Set up only if you land a $25k+ corporate project

---

### 🔴 **Venmo / Cash App / Zelle** (NOT RECOMMENDED)

**Processing:**
- Fee: 1.9%-2.9% for business transactions
- Processing time: Instant
- Deposit: Instant or 1-3 days to bank

**Why NOT Recommended:**

**Problems:**
- ❌ **Extremely unprofessional** for business
- ❌ No proper invoicing system
- ❌ No receipts or documentation
- ❌ Limited buyer/seller protection
- ❌ IRS may flag large/frequent amounts
- ❌ Harder to track for accounting/taxes
- ❌ Looks amateur (hurts your brand)
- ❌ Can't do recurring payments properly
- ❌ No integration with Moxie or Wave

**Only Acceptable Use:**
- Small jobs for friends/family (under $500)
- One-time emergency situations
- Splitting dinner bill with client (not payment!)

**If Client Suggests Venmo/Cash App:**
```
"I appreciate the thought, but I use Stripe for all business 
payments for proper record-keeping and tax purposes. You can 
pay by card or bank transfer through the invoice link - it's 
just as quick!"
```

**Do NOT make this a regular payment method.**

---

### 🔴 **Cash** (NOT RECOMMENDED)

**Why to Avoid:**
- ❌ No paper trail (tax/legal issues)
- ❌ Security risk (carrying large amounts)
- ❌ Unprofessional appearance
- ❌ Hard to track and account for
- ❌ IRS red flag for cash businesses
- ❌ Can't dispute or reverse if issues

**Only Time Cash is OK:**
- Friend owes you $50 for logo tweak
- Emergency payment at coffee shop meeting

**For Real Projects:** Always use Stripe/PayPal/Check

---

### 🟠 **Cryptocurrency (Bitcoin, Ethereum, etc.)** (ADVANCED - OPTIONAL)

**Processing:**
- Fee: Network fees (varies, usually $1-10)
- Processing time: 10 minutes to 1 hour (blockchain confirmation)
- Volatility risk: Price can change 5-10% during transaction

**How It Works:**
1. Client sends crypto to your wallet address
2. Transaction confirms on blockchain
3. You hold crypto or convert to USD immediately
4. Manage through crypto exchange (Coinbase, etc.)

**Pros:**
- ✅ Very low fees compared to cards
- ✅ Fast international transfers
- ✅ No middleman (bank-free)
- ✅ Some tech clients specifically want to pay in crypto
- ✅ Could appreciate in value (or depreciate)

**Cons:**
- ❌ Extreme price volatility (could lose 10% in a day)
- ❌ Complex tax reporting (every transaction is taxable event)
- ❌ Most clients don't own crypto
- ❌ Requires technical knowledge
- ❌ Convert-to-USD fees and delays
- ❌ Limited legal protection if issues arise
- ❌ Not widely adopted yet

**Best For:**
- Tech/crypto industry clients who specifically request it
- International clients in countries with currency restrictions
- You personally understand and use crypto

**Tax Implications:**
- Must report as income at USD value when received
- If crypto value changes before you sell, capital gain/loss
- Need crypto-specific accounting software
- Much more complex than traditional payments

**Setup Required:**
1. Create Coinbase or similar account
2. Get business crypto wallet
3. Learn tax implications
4. Decide on immediate conversion vs holding

**Recommendation:**
- Only accept if you understand crypto thoroughly
- Always convert to USD immediately (avoid volatility)
- Use service like BitPay that handles conversion automatically
- Don't make this your primary payment method

---

## 🎯 RECOMMENDED PAYMENT STRATEGY

### **TLDR: Use Stripe for Everything**

**What to Offer:**
- ✅ Stripe (credit/debit cards + ACH bank transfer)
- ✅ That's it!

**Why This Works:**
- Covers 95%+ of all payment scenarios
- Stripe accepts cards AND bank transfers
- Simpler for you to manage
- Faster for clients to pay
- Modern and professional
- Industry standard

**What About the Other 5%?**
- If client insists on check: Make one-time exception
- If client wants PayPal: Set up in 10 minutes if needed
- If client needs wire: Provide details for large projects

**But don't proactively offer these** - keep it simple until demand appears.

---

## 💳 STRIPE SETUP GUIDE

### **Step 1: Create Stripe Account**
1. Go to stripe.com
2. Click "Start now"
3. Enter email and create password
4. Choose "Individual" or "Company" (use your business structure)

### **Step 2: Complete Business Profile**
```
Business Name: RV Web Creations
Business Type: Individual/Sole Proprietor (or your structure)
Industry: Computer Programming/Web Development
Website: rvwebcreations.com
Business Address: [Your address]
Tax ID: Your SSN or EIN
Phone: Your business phone
```

### **Step 3: Connect Bank Account**
1. Add bank routing number
2. Add account number
3. Stripe verifies with micro-deposits (1-2 days)
4. Confirm amounts to activate

### **Step 4: Set Up Payouts**
```
Payout Schedule: Daily (or Weekly)
Payout Speed: Standard (2-3 days) - FREE
              or Instant (30 minutes) - 1% fee (not recommended)
```

### **Step 5: Connect to Moxie**
1. Log into Moxie
2. Go to Settings → Payments
3. Click "Connect Stripe"
4. Authorize connection
5. Test with sample invoice

### **Step 6: Enable ACH Payments**
1. In Stripe dashboard
2. Settings → Payment Methods
3. Enable "ACH Direct Debit"
4. Now clients can choose card OR bank account

### **Step 7: Test Everything**
1. Send yourself a test invoice
2. Try paying with test card (4242 4242 4242 4242)
3. Verify invoice marked as paid
4. Check Stripe dashboard shows transaction

**Total Setup Time: 20-30 minutes**

---

## 💰 PAYMENT TERMS & STRUCTURES

### **For New Website Projects:**

#### **Option 1: 50/50 Split** (RECOMMENDED - Most Common)
```
PROJECT: $5,000 Growth Site

Payment Schedule:
□ 50% Deposit ($2,500) - Due upon contract signing to begin work
□ 50% Final Payment ($2,500) - Due upon project completion before delivery

Total: $5,000
```

**Pros:**
- ✅ Simple and clear
- ✅ Industry standard
- ✅ Protects both parties equally
- ✅ Covers your initial time investment

**When to Use:** All Starter and Growth sites under $15k

---

#### **Option 2: 33/33/34 Split** (For Larger Projects $10k-$20k)
```
PROJECT: $12,000 Growth Site

Payment Schedule:
□ 33% Deposit ($4,000) - Due upon contract signing
□ 33% Milestone Payment ($4,000) - Due after design approval
□ 34% Final Payment ($4,000) - Due upon project completion

Total: $12,000
```

**Pros:**
- ✅ Reduces client risk (smaller deposits)
- ✅ Provides milestone accountability
- ✅ Better cash flow throughout project

**When to Use:** Projects $10k-$20k

---

#### **Option 3: 25/25/25/25 Split** (For Large Projects $20k+)
```
PROJECT: $24,000 Custom Site

Payment Schedule:
□ 25% Deposit ($6,000) - Due upon contract signing
□ 25% Phase 1 Payment ($6,000) - After design phase completion
□ 25% Phase 2 Payment ($6,000) - After development phase completion
□ 25% Final Payment ($6,000) - Upon launch and delivery

Total: $24,000
```

**Pros:**
- ✅ Easier for client to manage large amounts
- ✅ Tied to specific deliverables
- ✅ Steady cash flow for you

**When to Use:** Projects over $20k, complex builds

---

### **For Care Plans (Recurring Monthly):**

#### **Auto-Charge Setup** (RECOMMENDED)
```
CARE PLAN: $200/month

Payment Schedule:
- Automatically charged on 1st of each month
- Client card on file with Stripe
- Automatic receipt emailed
- No manual invoicing needed

Cancellation: 30 days notice required
```

**Setup in Moxie:**
1. Create recurring invoice template
2. Set frequency: Monthly
3. Set charge date: 1st of month
4. Enable auto-charge via Stripe
5. Client receives confirmation email

**Pros:**
- ✅ Completely automated (set and forget)
- ✅ Predictable income
- ✅ No chasing payments
- ✅ Client doesn't have to remember
- ✅ Failed payment auto-retry

---

#### **Manual Invoice (Alternative)**
```
CARE PLAN: $200/month

Payment Schedule:
- Invoice sent on 25th of each month
- Due by 1st of next month
- Client pays manually each month via Stripe link

Cancellation: 30 days notice required
```

**When to Use:**
- Client prefers manual approval each month
- Variable monthly work (invoice may change)
- Client company requires invoice approval process

---

### **For Website Refreshes:**

```
WEBSITE REFRESH: $3,500

Payment Schedule:
□ 50% Deposit ($1,750) - Due upon contract signing
□ 50% Final Payment ($1,750) - Due upon completion

OR for smaller refreshes:
□ 100% Payment ($1,500) - Due 50% upfront, 50% upon completion

Total: $3,500
```

---

## 📋 INVOICE TEMPLATES

### **New Project Invoice (Deposit)**

```
INVOICE #001
Date: November 21, 2025
Due: Upon Receipt

TO:
Johnson Law Firm
Sarah Johnson
sarah@johnsonlawfirm.com

FROM:
RV Web Creations
info@rvwebcreations.com

PROJECT: Growth Website Development

DESCRIPTION:
50% Project Deposit - Website development as outlined in 
proposal dated November 18, 2025. Includes 12-page website 
with blog, contact forms, and SEO optimization.

AMOUNT DUE: $4,000.00

PAYMENT METHODS:
Pay securely by clicking the button below.
All major credit cards and bank transfers accepted.

[Pay Invoice →]

TERMS:
- Work begins upon receipt of deposit
- Deposit is non-refundable once work commences
- Balance due upon project completion
- Final files delivered after full payment

Thank you for your business!
```

---

### **Final Payment Invoice**

```
INVOICE #002
Date: December 15, 2025
Due: Upon Receipt

TO:
Johnson Law Firm
Sarah Johnson
sarah@johnsonlawfirm.com

FROM:
RV Web Creations
info@rvwebcreations.com

PROJECT: Growth Website Development - Final Payment

DESCRIPTION:
Final 50% payment for website project. All work completed 
and approved. Site ready for launch upon payment.

AMOUNT DUE: $4,000.00

[Pay Invoice →]

TERMS:
- Final files and login credentials delivered upon payment
- Domain transfer and launch occurs within 24 hours of payment
- 30-day support included

Thank you for your business!
```

---

### **Monthly Care Plan Invoice**

```
INVOICE #015
Date: January 1, 2026
Due: Upon Receipt

TO:
Johnson Law Firm
Sarah Johnson
sarah@johnsonlawfirm.com

FROM:
RV Web Creations
info@rvwebcreations.com

SERVICE: Monthly Website Care Plan - January 2026

DESCRIPTION:
Standard Care Plan includes:
- Website monitoring and uptime tracking
- Plugin and security updates
- Monthly backup
- Priority email support
- Up to 2 hours of content updates

AMOUNT DUE: $200.00

[Pay Invoice →]

This invoice will be automatically charged to your card on 
file. Cancel anytime with 30 days notice.

Thank you for your business!
```

---

## 💬 CLIENT COMMUNICATION TEMPLATES

### **When Sending Initial Invoice (Deposit)**

```
Subject: Invoice for Website Project - Action Required

Hi Sarah,

Exciting news! I'm ready to start building your new website.

Attached is your invoice for the 50% project deposit ($4,000). 
Once this is received, I'll begin work immediately.

**To pay:**
1. Click the "Pay Invoice" button in the email
2. Enter your credit card or bank account information
3. You'll receive instant confirmation

**Payment is secure** - processed through Stripe, the same 
system used by Amazon, Shopify, and thousands of businesses.

I'm looking forward to creating something great for Johnson 
Law Firm!

Questions? Just reply to this email.

Best,
Ryan
RV Web Creations
info@rvwebcreations.com
```

---

### **When Sending Final Invoice**

```
Subject: Final Invoice - Your Website is Ready! 🎉

Hi Sarah,

Congratulations! Your website is complete and looks amazing.

Attached is your final invoice ($4,000). Once received, I'll:
✅ Provide all login credentials
✅ Transfer domain control
✅ Launch the site live
✅ Provide training session

**To pay and launch:**
Click the "Pay Invoice" button in the attached invoice.

Your site will be live within 24 hours of payment!

Excited to show the world your new website.

Best,
Ryan
```

---

### **When Client Asks "Can I Pay Another Way?"**

```
Hi [Client],

I use Stripe for all payments, which accepts:
• All major credit and debit cards
• Direct bank transfer (ACH)
• Apple Pay and Google Pay

When you open the invoice, you'll see options for both 
card and bank account payment - whichever you prefer!

Is there a specific payment method you're looking for? 
I'm happy to work with you.

Best,
Ryan
```

---

### **When Client Asks About Checks**

**Option A: Politely Decline**
```
I appreciate the thought! I use Stripe for all payments for 
security and record-keeping purposes. The good news is Stripe 
accepts direct bank transfers (ACH) which work just like 
checks but are faster and more secure. 

When you open the invoice, just select "Pay by Bank Account" 
instead of credit card. No fees on your end, and it's much 
faster than mailing a check!

Let me know if you need any help with this.
```

**Option B: Make Exception**
```
I typically use Stripe for all payments, but I'm happy to 
make an exception for you. 

Please make the check payable to:
RV Web Creations
[Your address]

Include Invoice #[number] in the memo line.

Once I receive and deposit the check (3-5 business days to 
clear), I'll begin work.

Thank you!
```

---

## 🔒 SECURITY & FRAUD PROTECTION

### **Stripe's Built-In Protection:**

**For You:**
- ✅ PCI compliance handled by Stripe (you never see card numbers)
- ✅ Radar fraud detection (blocks suspicious transactions)
- ✅ 3D Secure authentication for large amounts
- ✅ Chargeback protection (dispute resolution)
- ✅ Encrypted payment processing

**For Clients:**
- ✅ SSL encryption (secure payment page)
- ✅ Never stored on your systems
- ✅ Stripe's $2 billion fraud prevention system
- ✅ Verified by Visa / Mastercard SecureCode support

### **Best Practices:**

**Always:**
- ✅ Use official Stripe payment links only
- ✅ Enable two-factor authentication on Stripe account
- ✅ Monitor Stripe dashboard for unusual activity
- ✅ Keep Stripe email notifications enabled

**Never:**
- ❌ Email credit card numbers (huge security risk)
- ❌ Store client card info yourself
- ❌ Share your Stripe login credentials
- ❌ Process payments outside Stripe/Moxie system

---

## 📊 FEE CALCULATIONS & PRICING

### **Should You Pass Fees to Clients?**

**Option A: Build Into Pricing (RECOMMENDED)**
```
Project Price: $5,000 (fees already included)
Client pays: $5,000
Stripe fee: $145.30
You receive: $4,854.70

Client sees simple price, no confusion
```

**Option B: Add Fees to Invoice**
```
Project Price: $5,000
+ Processing fee (2.9%): $145
Total Due: $5,145

Client pays: $5,145
Stripe fee: $149.41
You receive: $4,995.59

Can seem nickel-and-dime-y to clients
```

**Option C: Offer Check Discount**
```
Card Payment: $5,000
Check Payment: $4,855 (3% discount)

Most pay by card anyway
Extra complexity
```

**Best Practice:** Use Option A - just build 3% into your base pricing and never mention it.

---

### **Fee Examples by Project Size:**

| Project Amount | Stripe Fee (Card) | Stripe Fee (ACH) | You Receive (Card) | You Receive (ACH) |
|----------------|-------------------|------------------|--------------------|--------------------|
| $1,500 | $43.80 | $5.00 | $1,456.20 | $1,495.00 |
| $2,500 | $72.80 | $5.00 | $2,427.20 | $2,495.00 |
| $5,000 | $145.30 | $5.00 | $4,854.70 | $4,995.00 |
| $10,000 | $290.30 | $5.00 | $9,709.70 | $9,995.00 |
| $15,000 | $435.30 | $5.00 | $14,564.70 | $14,995.00 |
| $20,000 | $580.30 | $5.00 | $19,419.70 | $19,995.00 |

**Key Insight:** ACH becomes MUCH more attractive for projects $5k+

---

## 🚨 LATE PAYMENT HANDLING

### **Prevention is Key:**

**Clear Payment Terms:**
```
- Deposit due upon signing (before work starts)
- Final payment due upon completion (before delivery)
- Care plans charged automatically on 1st of month
```

**Friendly Reminders:**

**Day 0: Invoice sent**
```
"Here's your invoice! Click to pay and I'll get started."
```

**Day 3: Gentle reminder (if not paid)**
```
"Just checking in - did you receive the invoice I sent on 
[date]? Let me know if you have any questions!"
```

**Day 7: Firmer reminder**
```
"I haven't received payment yet for Invoice #[number]. I'm 
excited to start your project! Please let me know if there's 
anything holding up payment."
```

**Day 14: Final notice**
```
"Invoice #[number] is now 14 days overdue. I'll need to 
receive payment by [date] or I'll have to pause/cancel the 
project per our contract terms. Please reach out if you're 
having issues."
```

### **Late Fees (Optional):**

Include in your contract:
```
LATE PAYMENT TERMS:
Invoices not paid within 14 days are subject to:
- 1.5% monthly late fee (18% annual)
- Project may be paused until payment received
- Final deliverables withheld until full payment

We understand circumstances arise - please communicate 
with us if you need alternative arrangements.
```

---

## ✅ PAYMENT WORKFLOW CHECKLIST

### **For Each New Project:**

**Before Work Starts:**
- [ ] Send proposal via Moxie
- [ ] Client signs contract
- [ ] Send 50% deposit invoice via Moxie/Stripe
- [ ] Wait for deposit to clear (2-3 days)
- [ ] Confirm payment received
- [ ] Begin work

**At Project Completion:**
- [ ] Complete all work per contract
- [ ] Send final invoice (50% balance)
- [ ] Wait for payment confirmation
- [ ] Once paid, deliver final files
- [ ] Provide login credentials
- [ ] Launch site (if applicable)
- [ ] Send thank you + request testimonial

**For Care Plans:**
- [ ] Set up recurring invoice in Moxie
- [ ] Enable auto-charge via Stripe
- [ ] Get client approval for auto-billing
- [ ] First payment processes on 1st of month
- [ ] Automatic thereafter (hands-free!)

---

## 📱 STRIPE MOBILE APP

**Download:** Stripe app for iOS/Android

**Use For:**
- ✅ Real-time payment notifications
- ✅ Check daily deposits
- ✅ View transaction history
- ✅ Respond to disputes
- ✅ Issue refunds (if needed)
- ✅ Monitor revenue on-the-go

**Set Up Notifications:**
- Enable "Payment received" alerts
- Enable "Payout sent" alerts
- Get instant confirmation without checking email

---

## 🎓 COMMON PAYMENT QUESTIONS

### **Q: What if client card is declined?**

**A:** Stripe will notify both you and client. Client can:
1. Try different card
2. Contact their bank (often fraud protection blocking)
3. Use ACH bank transfer instead
4. Wait and try again (temporary bank issue)

You'll see reason for decline in Stripe dashboard.

---

### **Q: What if I need to refund a payment?**

**A:** In Stripe dashboard:
1. Find transaction
2. Click "Refund"
3. Choose full or partial refund
4. Confirm

Stripe fees are returned to you on full refunds.
Client sees refund in 5-10 business days.

---

### **Q: What if client disputes/chargebacks?**

**A:** Stripe notifies you immediately. You have 7 days to respond with evidence:
- Contract/proposal showing agreed scope
- Emails showing client approval
- Proof of work delivered (screenshots, links)
- Communication history

Stripe reviews and makes decision. Win rate is high if you have good documentation (another reason to use ClickUp!).

---

### **Q: Do I need a separate business bank account?**

**A:** Legally not required for sole proprietors, but HIGHLY recommended:
- ✅ Separates personal and business finances
- ✅ Makes accounting much easier
- ✅ More professional
- ✅ Simplifies taxes
- ✅ Builds business credit

Open business checking at your bank (often free for sole proprietors).

---

### **Q: Do I need a merchant account?**

**A:** No! Stripe IS your merchant account. That's the whole point.

Traditional setup (old way):
- Merchant account + Payment gateway + Bank account = Complicated

Modern setup (Stripe):
- Stripe + Bank account = Done

---

### **Q: What about international clients?**

**A:** Stripe handles this automatically:
- Accepts cards from 195+ countries
- Automatic currency conversion
- Client pays in their currency
- You receive USD in your bank
- Stripe handles exchange rate

For large international projects, consider:
- Wire transfer (faster, but expensive)
- Wise (formerly TransferWise) - lower fees
- PayPal (more global presence)

---

## 🎯 QUICK START ACTION PLAN

### **Week 1: Setup**
- [ ] Day 1: Create Stripe account (30 min)
- [ ] Day 2: Connect bank account to Stripe
- [ ] Day 3: Connect Stripe to Moxie (10 min)
- [ ] Day 4: Create invoice template in Moxie
- [ ] Day 5: Send yourself test invoice
- [ ] Day 6: Test payment with Stripe test card
- [ ] Day 7: Update website/proposals to mention Stripe

### **First Client:**
- [ ] Send proposal via Moxie
- [ ] Client signs
- [ ] Send deposit invoice (50%)
- [ ] Client pays via Stripe
- [ ] Receive notification
- [ ] Wait 2-3 days for bank deposit
- [ ] Confirm deposit in bank
- [ ] Begin work!

### **Ongoing:**
- [ ] Check Stripe app daily for payments
- [ ] Send invoices immediately upon milestones
- [ ] Follow up on unpaid invoices after 3 days
- [ ] Keep Moxie/Wave in sync with bank deposits
- [ ] Set aside 25-30% of revenue for taxes

---

## 📈 PAYMENT BEST PRACTICES SUMMARY

### **DO:**
- ✅ Require deposits before starting work (always!)
- ✅ Use Stripe for 95% of payments
- ✅ Make it dead-simple for clients to pay (one click)
- ✅ Send invoices immediately when due
- ✅ Follow up on unpaid invoices promptly
- ✅ Automate recurring payments
- ✅ Build processing fees into your pricing
- ✅ Keep clear records of all payments
- ✅ Thank clients for prompt payment

### **DON'T:**
- ❌ Start work without deposit
- ❌ Deliver final files before final payment
- ❌ Accept cash for business transactions
- ❌ Use personal Venmo/CashApp for projects
- ❌ Waive fees to "be nice"
- ❌ Accept vague payment timelines
- ❌ Let invoices go unpaid for 30+ days
- ❌ Make payment complicated (too many options)
- ❌ Store client card info yourself (use Stripe)

---

## 💡 FINAL THOUGHTS

**Keep It Simple:**
- One payment processor (Stripe) covers 95% of needs
- Clear terms prevent payment issues
- Automation reduces manual work
- Professional system builds trust

**The Goal:**
- Get paid quickly and reliably
- Minimal friction for clients
- Automated where possible
- Professional appearance
- Proper financial records

**Remember:**
- Stripe fees are cost of doing business (worth it for convenience)
- Most clients PREFER card payments (easier for them)
- Clear communication prevents 90% of payment issues
- Deposits protect your time investment
- Payment before delivery gives you leverage

---

**Document Created:** November 21, 2025
**Last Updated:** November 21, 2025
**Version:** 1.0
