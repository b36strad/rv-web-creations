# Pricing Calculator Spreadsheet Guide
## Compatible with Microsoft Excel & Google Sheets

---

## SHEET 1: QUOTE CALCULATOR (Main Input Sheet)

### Layout Structure:

**SECTION A: CLIENT INFORMATION (Rows 1-8)**
```
Row 1:  [HEADER] RV WEB CREATIONS - PROJECT QUOTE CALCULATOR
Row 2:  [Empty for spacing]
Row 3:  Client Name:        [Input Cell B3]
Row 4:  Project Name:       [Input Cell B4]
Row 5:  Date:               [Formula: =TODAY()]
Row 6:  Quote Valid Until:  [Formula: =B5+30]
Row 7:  Contact Email:      [Input Cell B7]
Row 8:  [Empty for spacing]
```

**SECTION B: BASE PACKAGE SELECTION (Rows 9-13)**
```
Row 9:  BASE PACKAGE SELECTION
Row 10: [Empty]
Row 11: Column A: "Package Type"  |  Column B: "Select (X)"  |  Column C: "Base Price"  |  Column D: "Your Price"
Row 12: Starter Site (4-6 pages)  |  [Input]                 |  $2,500                  |  [Formula: =IF(B12="X",C12,0)]
Row 13: Growth Site (8-20 pages)  |  [Input]                 |  $7,500                  |  [Formula: =IF(B13="X",C13,0)]
Row 14: Custom Site (complex)     |  [Input]                 |  $18,000                 |  [Formula: =IF(B14="X",C14,0)]
Row 15: [Empty]
Row 16: Selected Base:            |  [Formula: =SUM(D12:D14)]
```

**SECTION C: PAGE COUNT ADJUSTMENTS (Rows 17-27)**
```
Row 17: PAGE COUNT ADJUSTMENTS
Row 18: [Empty]
Row 19: Column A: "Pages"  |  Column B: "Select (X)"  |  Column C: "Package"  |  Column D: "Price"  |  Column E: "Your Price"
Row 20: 4-6 pages          |  [Input]                 |  Starter              |  $0                 |  [Formula: =IF(B20="X",D20,0)]
Row 21: 8-10 pages         |  [Input]                 |  Growth/Custom        |  $0                 |  [Formula: =IF(B21="X",D21,0)]
Row 22: 11-15 pages        |  [Input]                 |  Growth               |  $1,500             |  [Formula: =IF(B22="X",D22,0)]
Row 23: 11-15 pages        |  [Input]                 |  Custom               |  $2,000             |  [Formula: =IF(B23="X",D23,0)]
Row 24: 16-20 pages        |  [Input]                 |  Growth               |  $3,000             |  [Formula: =IF(B24="X",D24,0)]
Row 25: 16-20 pages        |  [Input]                 |  Custom               |  $4,000             |  [Formula: =IF(B25="X",D25,0)]
Row 26: 21-30 pages        |  [Input]                 |  Custom               |  $6,000             |  [Formula: =IF(B26="X",D26,0)]
Row 27: 31+ pages          |  [Input]                 |  Custom               |  $10,000            |  [Formula: =IF(B27="X",D27,0)]
Row 28: [Empty]
Row 29: Page Count Total:  |                          |                       |                     |  [Formula: =SUM(E20:E27)]
```

**SECTION D: E-COMMERCE FEATURES (Rows 30-43)**
```
Row 30: E-COMMERCE FEATURES
Row 31: [Empty]
Row 32: Column A: "Feature"                    |  Column B: "Select (X)"  |  Column C: "Price"  |  Column D: "Your Price"
Row 33: No e-commerce                          |  [Input]                 |  $0                 |  [Formula: =IF(B33="X",C33,0)]
Row 34: Simple store (5-20 products)           |  [Input]                 |  $2,750             |  [Formula: =IF(B34="X",C34,0)]
Row 35: Medium store (21-100 products)         |  [Input]                 |  $5,500             |  [Formula: =IF(B35="X",C35,0)]
Row 36: Large store (100+ products)            |  [Input]                 |  $11,500            |  [Formula: =IF(B36="X",C36,0)]
Row 37: Product variants (sizes, colors)       |  [Input]                 |  $1,000             |  [Formula: =IF(B37="X",C37,0)]
Row 38: Inventory management                   |  [Input]                 |  $1,500             |  [Formula: =IF(B38="X",C38,0)]
Row 39: Subscriptions/recurring billing        |  [Input]                 |  $2,000             |  [Formula: =IF(B39="X",C39,0)]
Row 40: Advanced shipping calculations         |  [Input]                 |  $1,000             |  [Formula: =IF(B40="X",C40,0)]
Row 41: Multi-currency                         |  [Input]                 |  $1,500             |  [Formula: =IF(B41="X",C41,0)]
Row 42: Product reviews system                 |  [Input]                 |  $800               |  [Formula: =IF(B42="X",C42,0)]
Row 43: [Empty]
Row 44: E-commerce Total:                      |                          |                     |  [Formula: =SUM(D33:D42)]
```

**SECTION E: CONTENT PREPARATION (Rows 45-53)**
```
Row 45: CONTENT PREPARATION
Row 46: [Empty]
Row 47: Column A: "Service"                    |  Column B: "Select (X)"  |  Column C: "Price"  |  Column D: "Your Price"
Row 48: Content ready (organized, approved)    |  [Input]                 |  $0                 |  [Formula: =IF(B48="X",C48,0)]
Row 49: Partial (needs organization)           |  [Input]                 |  $750               |  [Formula: =IF(B49="X",C49,0)]
Row 50: Need help (writing/sourcing needed)    |  [Input]                 |  $2,250             |  [Formula: =IF(B50="X",C50,0)]
Row 51: Full copywriting (all pages)           |  [Input]                 |  $4,000             |  [Formula: =IF(B51="X",C51,0)]
Row 52: Professional photography               |  [Input]                 |  $1,250             |  [Formula: =IF(B52="X",C52,0)]
Row 53: Stock photo curation                   |  [Input]                 |  $400               |  [Formula: =IF(B53="X",C53,0)]
Row 54: [Empty]
Row 55: Content Total:                         |                          |                     |  [Formula: =SUM(D48:D53)]
```

**SECTION F: CUSTOM FEATURES & INTEGRATIONS (Rows 56-79)**
```
Row 56: CUSTOM FEATURES & INTEGRATIONS
Row 57: [Empty]
Row 58: Column A: "Feature"                    |  Column B: "Select (X)"  |  Column C: "Price"  |  Column D: "Your Price"
Row 59: Contact form (basic)                   |  [Input]                 |  $0                 |  [Formula: =IF(B59="X",C59,0)]
Row 60: Multi-step form                        |  [Input]                 |  $750               |  [Formula: =IF(B60="X",C60,0)]
Row 61: Booking system (simple)                |  [Input]                 |  $2,000             |  [Formula: =IF(B61="X",C61,0)]
Row 62: Booking system (complex)               |  [Input]                 |  $4,000             |  [Formula: =IF(B62="X",C62,0)]
Row 63: Member login/portal                    |  [Input]                 |  $4,500             |  [Formula: =IF(B63="X",C63,0)]
Row 64: Blog with categories/tags              |  [Input]                 |  $650               |  [Formula: =IF(B64="X",C64,0)]
Row 65: Newsletter signup                      |  [Input]                 |  $300               |  [Formula: =IF(B65="X",C65,0)]
Row 66: CRM integration (HubSpot, Salesforce)  |  [Input]                 |  $1,750             |  [Formula: =IF(B66="X",C66,0)]
Row 67: Payment gateway (Stripe, PayPal)       |  [Input]                 |  $1,150             |  [Formula: =IF(B67="X",C67,0)]
Row 68: Custom API integration                 |  [Input]                 |  $3,500             |  [Formula: =IF(B68="X",C68,0)]
Row 69: Multi-language support (per language)  |  [Input]                 |  $3,000             |  [Formula: =IF(B69="X",C69,0)]
Row 70: Advanced search/filtering              |  [Input]                 |  $2,250             |  [Formula: =IF(B70="X",C70,0)]
Row 71: Map with locations                     |  [Input]                 |  $450               |  [Formula: =IF(B71="X",C71,0)]
Row 72: Interactive calculator/tool            |  [Input]                 |  $2,750             |  [Formula: =IF(B72="X",C72,0)]
Row 73: Live chat integration                  |  [Input]                 |  $400               |  [Formula: =IF(B73="X",C73,0)]
Row 74: Social media feeds                     |  [Input]                 |  $550               |  [Formula: =IF(B74="X",C74,0)]
Row 75: Custom contact form fields             |  [Input]                 |  $300               |  [Formula: =IF(B75="X",C75,0)]
Row 76: Event calendar                         |  [Input]                 |  $1,200             |  [Formula: =IF(B76="X",C76,0)]
Row 77: Portfolio/gallery showcase             |  [Input]                 |  $800               |  [Formula: =IF(B77="X",C77,0)]
Row 78: [Empty]
Row 79: Features Total:                        |                          |                     |  [Formula: =SUM(D59:D77)]
```

**SECTION G: DESIGN COMPLEXITY (Rows 80-89)**
```
Row 80: DESIGN COMPLEXITY
Row 81: [Empty]
Row 82: Column A: "Level"                      |  Column B: "Select (X)"  |  Column C: "Price"  |  Column D: "Your Price"
Row 83: Template-based                         |  [Input]                 |  -$500              |  [Formula: =IF(B83="X",C83,0)]
Row 84: Semi-custom (custom home, templated)   |  [Input]                 |  $0                 |  [Formula: =IF(B84="X",C84,0)]
Row 85: Fully custom (all pages from scratch)  |  [Input]                 |  $3,000             |  [Formula: =IF(B85="X",C85,0)]
Row 86: Complex animations                     |  [Input]                 |  $2,250             |  [Formula: =IF(B86="X",C86,0)]
Row 87: Custom illustrations                   |  [Input]                 |  $2,000             |  [Formula: =IF(B87="X",C87,0)]
Row 88: Video integration                      |  [Input]                 |  $850               |  [Formula: =IF(B88="X",C88,0)]
Row 89: Advanced UI/UX research                |  [Input]                 |  $3,500             |  [Formula: =IF(B89="X",C89,0)]
Row 90: [Empty]
Row 91: Design Total:                          |                          |                     |  [Formula: =SUM(D83:D89)]
```

**SECTION H: TECHNICAL REQUIREMENTS (Rows 92-101)**
```
Row 92:  TECHNICAL REQUIREMENTS
Row 93:  [Empty]
Row 94:  Column A: "Requirement"                    |  Column B: "Select (X)"  |  Column C: "Price"  |  Column D: "Your Price"
Row 95:  Performance optimization (advanced)        |  [Input]                 |  $1,150             |  [Formula: =IF(B95="X",C95,0)]
Row 96:  Advanced SEO (schema, sitemap, redirects)  |  [Input]                 |  $1,500             |  [Formula: =IF(B96="X",C96,0)]
Row 97:  Accessibility compliance (WCAG AA)         |  [Input]                 |  $2,250             |  [Formula: =IF(B97="X",C97,0)]
Row 98:  Security hardening (advanced)              |  [Input]                 |  $1,500             |  [Formula: =IF(B98="X",C98,0)]
Row 99:  Custom database                            |  [Input]                 |  $3,750             |  [Formula: =IF(B99="X",C99,0)]
Row 100: Progressive Web App (PWA)                  |  [Input]                 |  $5,000             |  [Formula: =IF(B100="X",C100,0)]
Row 101: [Empty]
Row 102: Technical Total:                           |                          |                     |  [Formula: =SUM(D95:D100)]
```

**SECTION I: MIGRATION & DATA TRANSFER (Rows 103-112)**
```
Row 103: MIGRATION & DATA TRANSFER
Row 104: [Empty]
Row 105: Column A: "Task"                      |  Column B: "Select (X)"  |  Column C: "Price"  |  Column D: "Your Price"
Row 106: No migration (new site)               |  [Input]                 |  $0                 |  [Formula: =IF(B106="X",C106,0)]
Row 107: Simple migration (10-20 pages)        |  [Input]                 |  $1,000             |  [Formula: =IF(B107="X",C107,0)]
Row 108: Medium migration (20-50 pages)        |  [Input]                 |  $2,000             |  [Formula: =IF(B108="X",C108,0)]
Row 109: Large migration (50-100 pages)        |  [Input]                 |  $4,000             |  [Formula: =IF(B109="X",C109,0)]
Row 110: Database migration                    |  [Input]                 |  $1,500             |  [Formula: =IF(B110="X",C110,0)]
Row 111: E-commerce product migration (per 100)|  [Input]                 |  $750               |  [Formula: =IF(B111="X",C111,0)]
Row 112: URL redirect mapping                  |  [Input]                 |  $750               |  [Formula: =IF(B112="X",C112,0)]
Row 113: [Empty]
Row 114: Migration Total:                      |                          |                     |  [Formula: =SUM(D106:D112)]
```

**SECTION J: TIMELINE ADJUSTMENTS (Rows 115-122)**
```
Row 115: TIMELINE & RUSH FEES
Row 116: [Empty]
Row 117: Column A: "Timeline"                  |  Column B: "Select (X)"  |  Column C: "Multiplier"  |  Column D: "Applied"
Row 118: Standard (4-8 weeks)                  |  [Input]                 |  0%                      |  [Formula: =IF(B118="X",1,0)]
Row 119: Rush (2-4 weeks)                      |  [Input]                 |  25%                     |  [Formula: =IF(B119="X",1.25,0)]
Row 120: Express (<2 weeks)                    |  [Input]                 |  50%                     |  [Formula: =IF(B120="X",1.5,0)]
Row 121: Flexible (no deadline)                |  [Input]                 |  -10%                    |  [Formula: =IF(B121="X",0.9,0)]
Row 122: [Empty]
Row 123: Timeline Multiplier:                  |                          |                          |  [Formula: =MAX(D118:D121)]
Row 124: Note: If no timeline selected, defaults to Standard (1.0)
```

**SECTION K: SUBTOTAL & ADJUSTMENTS (Rows 125-140)**
```
Row 125: [Empty]
Row 126: ═══════════════════════════════════════════════════════════
Row 127: SUBTOTAL BEFORE TIMELINE
Row 128: [Empty]
Row 129: Base Package:         |  [Formula: =D16]
Row 130: Page Adjustments:     |  [Formula: =E29]
Row 131: E-commerce:           |  [Formula: =D44]
Row 132: Content:              |  [Formula: =D55]
Row 133: Features:             |  [Formula: =D79]
Row 134: Design:               |  [Formula: =D91]
Row 135: Technical:            |  [Formula: =D102]
Row 136: Migration:            |  [Formula: =D114]
Row 137: [Empty]
Row 138: SUBTOTAL:             |  [Formula: =SUM(D129:D136)]
Row 139: [Empty]
Row 140: Timeline Adjustment:  |  [Formula: =IF(D123=0,D138,D138*(D123-1))]
```

**SECTION L: DISCOUNTS (Rows 141-151)**
```
Row 141: [Empty]
Row 142: DISCOUNTS (Optional)
Row 143: [Empty]
Row 144: Column A: "Discount Type"             |  Column B: "Apply (X)"  |  Column C: "%"  |  Column D: "Amount"
Row 145: Nonprofit organization                |  [Input]                |  15%            |  [Formula: =IF(B145="X",-(D138+D140)*0.15,0)]
Row 146: Client referral                       |  [Input]                |  10%            |  [Formula: =IF(B146="X",-(D138+D140)*0.10,0)]
Row 147: Multi-project commitment              |  [Input]                |  12%            |  [Formula: =IF(B147="X",-(D138+D140)*0.12,0)]
Row 148: Flexible timeline (3+ months)         |  [Input]                |  10%            |  [Formula: =IF(B148="X",-(D138+D140)*0.10,0)]
Row 149: Cash payment upfront                  |  [Input]                |  5%             |  [Formula: =IF(B149="X",-(D138+D140)*0.05,0)]
Row 150: [Empty]
Row 151: Total Discount:                       |                         |                 |  [Formula: =SUM(D145:D149)]
```

**SECTION M: FINAL TOTAL (Rows 152-165)**
```
Row 152: [Empty]
Row 153: ═══════════════════════════════════════════════════════════
Row 154: [Empty]
Row 155: Column A                              |  Column B (Bold, Large Font)
Row 156: SUBTOTAL:                             |  [Formula: =D138]
Row 157: Timeline Adjustment:                  |  [Formula: =D140]
Row 158: Discounts:                            |  [Formula: =D151]
Row 159: [Empty]
Row 160: PROJECT TOTAL:                        |  [Formula: =D138+D140+D151]
Row 161: [Empty]
Row 162: ═══════════════════════════════════════════════════════════
Row 163: [Empty]
Row 164: Effective Hourly Rate Check:
Row 165: Estimated Hours:      [Input Cell B165]
Row 166: Hourly Rate:          [Formula: =D160/B165]
Row 167: Target: $100-150/hour
Row 168: [Conditional formatting: Red if <$100, Green if >$100]
```

---

## SHEET 2: PRICING DATABASE (Reference Sheet)

This sheet stores all your prices in one place for easy updates.

```
Row 1:  PRICING DATABASE - Update prices here and they flow to Quote Calculator
Row 2:  [Empty]
Row 3:  Column A: "Category"  |  Column B: "Item"  |  Column C: "Price"  |  Column D: "Notes"
Row 4:  Base Packages         |  Starter           |  $2,500             |  4-6 pages
Row 5:  Base Packages         |  Growth            |  $7,500             |  8-20 pages
Row 6:  Base Packages         |  Custom            |  $18,000            |  Complex sites
Row 7:  [Empty]
Row 8:  Hourly Rates          |  Standard          |  $125               |  Your base hourly
Row 9:  Hourly Rates          |  Content Writing   |  $100               |  Copywriting
Row 10: Hourly Rates          |  Consultation      |  $150               |  Strategy calls
Row 11: [Empty]
Row 12: E-commerce            |  Simple Store      |  $2,750             |  5-20 products
Row 13: E-commerce            |  Medium Store      |  $5,500             |  21-100 products
Row 14: E-commerce            |  Large Store       |  $11,500            |  100+ products
[Continue with all pricing items from the calculator...]
```

**Note:** In the Quote Calculator sheet, you can reference these cells instead of hardcoding prices. For example:
- In Quote Calculator C12, instead of typing $2,500, use: `='Pricing Database'!C4`
- This way, updating one cell updates everywhere

---

## SHEET 3: QUOTE OUTPUT (Client-Facing)

This is a formatted, printable proposal that pulls data from Sheet 1.

```
Row 1:  [LOGO/HEADER] RV WEB CREATIONS
Row 2:  Professional Web Design & Development
Row 3:  [Empty]
Row 4:  PROJECT PROPOSAL
Row 5:  [Empty]
Row 6:  Prepared for:  [Formula: ='Quote Calculator'!B3]
Row 7:  Project:       [Formula: ='Quote Calculator'!B4]
Row 8:  Date:          [Formula: ='Quote Calculator'!B5]
Row 9:  Valid Until:   [Formula: ='Quote Calculator'!B6]
Row 10: [Empty]
Row 11: ═══════════════════════════════════════════════════════════
Row 12: [Empty]
Row 13: PROJECT SCOPE & PRICING
Row 14: [Empty]
Row 15: Base Package:
Row 16: [Formula: =IF('Quote Calculator'!B12="X","Starter Site - $2,500","")]
Row 17: [Formula: =IF('Quote Calculator'!B13="X","Growth Site - $7,500","")]
Row 18: [Formula: =IF('Quote Calculator'!B14="X","Custom Site - $18,000","")]
Row 19: [Empty]
Row 20: Additional Features:
Row 21: [Use IF formulas to display only selected features with prices]
Row 22: [Formula: =IF('Quote Calculator'!B34="X","• Simple E-commerce Store: $" & 'Quote Calculator'!C34,"")]
Row 23: [Formula: =IF('Quote Calculator'!B61="X","• Booking System (Simple): $" & 'Quote Calculator'!C61,"")]
[Continue for all features...]

Row 50: [Empty]
Row 51: ═══════════════════════════════════════════════════════════
Row 52: [Empty]
Row 53: INVESTMENT BREAKDOWN
Row 54: [Empty]
Row 55: Subtotal:              $[Formula: ='Quote Calculator'!D138]
Row 56: Timeline Adjustment:   $[Formula: ='Quote Calculator'!D140]
Row 57: Discounts Applied:     $[Formula: ='Quote Calculator'!D151]
Row 58: [Empty]
Row 59: PROJECT TOTAL:         $[Formula: ='Quote Calculator'!D160] (Bold, Large, Highlighted)
Row 60: [Empty]
Row 61: ═══════════════════════════════════════════════════════════
Row 62: [Empty]
Row 63: PAYMENT SCHEDULE
Row 64: Deposit (50%):         $[Formula: ='Quote Calculator'!D160*0.5]  Due upon acceptance
Row 65: Midpoint (25%):        $[Formula: ='Quote Calculator'!D160*0.25] Due at design approval
Row 66: Final (25%):           $[Formula: ='Quote Calculator'!D160*0.25] Due before launch
Row 67: [Empty]
Row 68: ═══════════════════════════════════════════════════════════
Row 69: [Empty]
Row 70: NEXT STEPS
Row 71: 1. Review this proposal
Row 72: 2. Reply with any questions
Row 73: 3. Sign & return contract with deposit
Row 74: 4. We'll schedule kickoff call within 2 business days
Row 75: [Empty]
Row 76: Questions? Email: info@rvwebcreations.com
Row 77: [Empty]
Row 78: Thank you for considering RV Web Creations!
```

---

## SHEET 4: PROJECT HISTORY

Track all quotes you've sent.

```
Row 1:  PROJECT QUOTE HISTORY
Row 2:  [Empty]
Row 3:  Column Headers:
        A: Date | B: Client Name | C: Project Type | D: Quote Amount | E: Status | F: Notes
Row 4:  [Data entry row]
Row 5:  [Data entry row]
[Continue...]

Bottom Section: Summary Statistics
Row 100: [Empty]
Row 101: SUMMARY STATISTICS
Row 102: Total Quotes Sent:        [Formula: =COUNTA(B4:B99)]
Row 103: Total Value Quoted:       [Formula: =SUM(D4:D99)]
Row 104: Average Quote Value:      [Formula: =AVERAGE(D4:D99)]
Row 105: Accepted Quotes:          [Formula: =COUNTIF(E4:E99,"Accepted")]
Row 106: Conversion Rate:          [Formula: =E105/E102]
```

---

## FORMULAS REFERENCE

### Key Formulas That Work in Both Excel & Google Sheets:

**1. Checkbox Selection (X marks)**
```
=IF(B12="X",C12,0)
```
Explanation: If cell B12 contains "X", return the price from C12, otherwise return 0.

**2. Sum of Selected Items**
```
=SUM(D12:D14)
```
Explanation: Adds all values in the range.

**3. Timeline Multiplier**
```
=MAX(D118:D121)
```
Explanation: Gets the highest value (the selected multiplier).

**4. Timeline Adjustment Calculation**
```
=IF(D123=0,D138,D138*(D123-1))
```
Explanation: If no timeline selected (0), use subtotal as-is. Otherwise, calculate the extra charge.

**5. Discount Calculation**
```
=IF(B145="X",-(D138+D140)*0.15,0)
```
Explanation: If discount is selected, calculate 15% of subtotal+timeline as a negative number.

**6. Display Only Selected Features (Quote Output)**
```
=IF('Quote Calculator'!B34="X","• Simple E-commerce Store: $" & 'Quote Calculator'!C34,"")
```
Explanation: If feature is selected on Calculator sheet, display formatted text with price.

**7. Conditional Formatting for Hourly Rate**
Excel:
- Select cell D166
- Home > Conditional Formatting > New Rule
- Format cells that contain > Cell Value < 100 (Red)
- Format cells that contain > Cell Value >= 100 (Green)

Google Sheets:
- Select cell D166
- Format > Conditional formatting
- Format cells if... Custom formula is: =D166<100 (Red)
- Add another rule: =D166>=100 (Green)

---

## FORMATTING TIPS

### Color Coding:
- **Section Headers:** Dark blue background (#1f4f7b), white text
- **Base Package Selected:** Yellow highlight (#f8b400)
- **Subtotals:** Light gray background (#f0f0f0)
- **Final Total:** Gold background (#f8b400), bold text
- **Warnings (<$100/hr):** Red background

### Cell Protection:
1. Lock all cells except input cells (the "Select (X)" column)
2. Excel: Review > Protect Sheet
3. Google Sheets: Data > Protected sheets and ranges
4. This prevents accidentally overwriting formulas

### Data Validation:
For "Select (X)" cells:
1. Select all input cells (Column B in calculator)
2. Data > Data Validation
3. Criteria: List of items: X
4. This creates a dropdown with just "X" or blank

---

## SETUP INSTRUCTIONS

### Step 1: Create the Spreadsheet
1. Open Excel or Google Sheets
2. Create new workbook: "RV Web Creations - Pricing Calculator"
3. Create 4 sheets: Quote Calculator, Pricing Database, Quote Output, Project History

### Step 2: Build Sheet 1 (Quote Calculator)
1. Copy the layout structure above
2. Enter all formulas in Column D and E (Your Price columns)
3. Format section headers with blue background
4. Add data validation to all "Select (X)" cells (Column B)

### Step 3: Build Sheet 2 (Pricing Database)
1. Enter all pricing items in organized categories
2. This is your master price list
3. (Optional) Update Sheet 1 formulas to reference Sheet 2 cells

### Step 4: Build Sheet 3 (Quote Output)
1. Create professional proposal layout
2. Add formulas to pull data from Sheet 1
3. Format for printing (hide gridlines, set print area)
4. Add your logo/branding

### Step 5: Build Sheet 4 (Project History)
1. Create simple table with date, client, amount, status
2. Add summary formulas at bottom

### Step 6: Test & Protect
1. Test all formulas with sample project
2. Verify totals calculate correctly
3. Protect formula cells (leave only input cells editable)
4. Save template copy

---

## USAGE WORKFLOW

### For Each New Quote:
1. **Save a Copy:** File > Make a Copy (name it "Quote - ClientName - Date")
2. **Clear Previous Data:** Remove all "X" marks from previous quote
3. **Enter Client Info:** Fill in name, project, date (top section)
4. **Select Base Package:** Mark appropriate package with "X"
5. **Select Features:** Go through each section, mark needed features
6. **Select Timeline:** Choose timeline (standard/rush/flexible)
7. **Apply Discounts:** If applicable, mark discount type
8. **Review Totals:** Check subtotal and final total make sense
9. **Check Hourly Rate:** Verify effective hourly rate is $100-150+
10. **Generate Proposal:** Switch to Sheet 3 (Quote Output)
11. **Print/Export PDF:** File > Print or Download as PDF
12. **Log in History:** Add entry to Sheet 4 with client and amount
13. **Send to Client:** Email PDF proposal

### Tips:
- Keep the master template clean (no "X" marks)
- Always work from a copy, never the template
- Review effective hourly rate before sending
- Save accepted quotes in "Accepted Quotes" folder
- Update pricing database quarterly to adjust for inflation/experience

---

## ADVANCED FEATURES (Optional)

### Add Custom Page Count Input:
Instead of checkboxes for page ranges, add a numeric input:
```
Row 20: Number of pages:  [Input]
Formula: =IF(AND(B20>=4,B20<=6),0,IF(AND(B20>=8,B20<=10),0,IF(AND(B20>=11,B20<=15),1500,...)))
```

### Add Hours Estimator:
Calculate estimated hours based on selections:
```
Simple page = 4 hours each
Complex feature = 10 hours each
Total hours formula = (pages*4) + (features*multiplier)
```

### Add Profit Margin Calculator:
```
Row 170: Estimated Costs:     [Input your costs: software, stock photos, etc.]
Row 171: Net Profit:          [Formula: =D160-B170]
Row 172: Profit Margin:       [Formula: =(D171/D160)*100] %
```

### Add Comparison View:
Show Starter vs Growth vs Custom side-by-side for client to compare.

---

## TROUBLESHOOTING

**Problem:** Formulas not calculating
- **Fix:** Check that cells are formatted as "Number" not "Text"
- **Fix:** Ensure "X" is uppercase in validation

**Problem:** Quote output showing #REF! error
- **Fix:** Verify sheet names match exactly in formulas
- **Fix:** Check that referenced cells exist

**Problem:** Effective hourly rate seems wrong
- **Fix:** Update estimated hours (Row 165)
- **Fix:** Ensure all selected features are priced

**Problem:** Timeline multiplier not applying
- **Fix:** Make sure only ONE timeline option has "X"
- **Fix:** Check MAX formula in D123 is working

---

## MAINTENANCE

### Monthly:
- [ ] Review Project History stats
- [ ] Calculate average quote value
- [ ] Check conversion rate
- [ ] Adjust prices if needed

### Quarterly:
- [ ] Raise prices 5-10% if booked solid
- [ ] Add new features/services to database
- [ ] Review and update hourly rates
- [ ] Backup all quote files

### Annually:
- [ ] Major pricing review
- [ ] Update proposal design/branding
- [ ] Analyze most profitable project types
- [ ] Set new income goals

---

## QUICK START METHOD (Easiest)

Since CSV files don't preserve formulas, here's the fastest way to get started:

### Method 1: Build Just the Essentials (15 minutes)

1. **Open Excel or Google Sheets** - Create new blank workbook

2. **Set up the top section:**
   ```
   A1: RV WEB CREATIONS - PRICING CALCULATOR
   A3: Client Name:          B3: [leave blank for input]
   A4: Project Name:         B4: [leave blank for input]
   A5: Date:                 B5: =TODAY()
   ```

3. **Create Base Package Section:**
   ```
   A7: BASE PACKAGE
   A8: Package              B8: Select    C8: Price    D8: Total
   A9: Starter (4-6 pages)  B9: [blank]   C9: 2500     D9: =IF(B9="X",C9,0)
   A10: Growth (8-20 pages) B10: [blank]  C10: 7500    D10: =IF(B10="X",C10,0)
   A11: Custom (complex)    B11: [blank]  C11: 18000   D11: =IF(B11="X",C11,0)
   
   A12: Base Total:                                    D12: =SUM(D9:D11)
   ```

4. **Add a few key features:**
   ```
   A14: ADD-ONS
   A15: Feature                    B15: Select    C15: Price    D15: Total
   A16: Simple E-commerce          B16: [blank]   C16: 2750     D16: =IF(B16="X",C16,0)
   A17: Blog section               B17: [blank]   C17: 650      D17: =IF(B17="X",C17,0)
   A18: Booking system             B18: [blank]   C18: 2000     D18: =IF(B18="X",C18,0)
   A19: Full copywriting           B19: [blank]   C19: 4000     D19: =IF(B19="X",C19,0)
   
   A20: Add-ons Total:                                          D20: =SUM(D16:D19)
   ```

5. **Create PROJECT TOTAL:**
   ```
   A22: PROJECT TOTAL:                                          D22: =D12+D20
   ```

6. **Test it:**
   - Type "X" in B9 (Starter package)
   - Type "X" in B16 (E-commerce)
   - D22 should show $5,250

7. **Once working, add more features** using the same pattern

### Method 2: Use Google Sheets Template Function

If you use Google Sheets:

1. Go to Google Sheets
2. Create new spreadsheet
3. Name it "RV Web Creations Pricing Calculator"
4. Copy and paste sections from the guide above one at a time
5. After pasting, click cells with formulas and press Enter to activate them

### Method 3: I Can Create a Google Sheets Link

If you have a Google account, I can provide you with instructions to create a shareable template that you can copy.

---

## NEXT STEPS

1. Start with Quick Start Method 1 (just 15 minutes)
2. Test that basic version works
3. Gradually add more feature sections using the same pattern
4. Once comfortable, add timeline multipliers and discounts
5. Format for professional appearance
6. Protect formula cells
7. Save master template
8. Create your first real client quote!

---

**File Naming Convention:**
- Master: `RV-Web-Creations-Pricing-Calculator-MASTER.xlsx`
- Quotes: `Quote-[ClientName]-[Date]-[ProjectName].xlsx`
- Archive: `[Year]-[Month]-Quote-[ClientName].xlsx`

**Backup:** Save to cloud (Google Drive, OneDrive, Dropbox) and keep local copy.
