# Pre-Launch Checklist

**Project:** RV Web Creations  
**Created:** December 12, 2025  
**Status:** Pre-Launch Testing Phase

---

## Critical Items (Must Complete Before Launch)

### 1. Mobile Table Testing ⚠️ HIGH PRIORITY
**Status:** Not tested on device  
**Location:** `src/services.html` - Compare Packages table

**Action Items:**
- [ ] Copy updated `services.html` and `styles.css` to Android phone
- [ ] Import into Spck Editor
- [ ] Open in Samsung Android Firefox browser
- [ ] Verify all 4 columns visible (Feature, Starter, Growth, Custom)
- [ ] Check "Custom" column header displays completely (was cutting off at "o")
- [ ] Test in portrait and landscape orientations
- [ ] Also verify pricing page table still works correctly

**Expected Result:** All columns visible without horizontal scroll or cut-off

---

### 2. Form Functionality Testing
**Status:** Not tested in production  
**Locations:** 
- `src/contact.html` - Contact form
- `src/project-intake.html` - Project intake form

**Action Items:**

#### Contact Form (`contact-handler.php`)
- [ ] Upload PHP handler to web host
- [ ] Submit test message with valid data
- [ ] Confirm email arrives at your inbox
- [ ] Verify email format is readable
- [ ] Test with invalid email format (should show error)
- [ ] Test with empty required fields (should show validation)
- [ ] Test honeypot spam protection (add text to hidden `website_url` field)
- [ ] Check mobile form display and submission
- [ ] Verify success message displays after submission
- [ ] Test loading spinner appears during submission

#### Project Intake Form (`intake-handler.php`)
- [ ] Upload PHP handler to web host
- [ ] Submit complete intake form
- [ ] Confirm email arrives with all fields
- [ ] Test all dropdown/select options
- [ ] Test checkbox selections
- [ ] Verify file upload works (if applicable)
- [ ] Test validation on required fields
- [ ] Mobile form testing

**Notes:**
- Update PHP handler email addresses to your actual email
- Check spam folder if test emails don't arrive
- Consider adding email confirmation to users

---

### 3. Link & Navigation Audit
**Status:** Not verified  

**Action Items:**
- [ ] **Navigation Links** - Click every nav link on every page
- [ ] **Footer Links** - Verify all footer links work
- [ ] **Button CTAs** - Test all "Get Started", "View Demo", "Contact" buttons
- [ ] **Internal Links** - Check text links within content
- [ ] **External Links** - Verify demo links open in new tab
- [ ] **Package Links** - Test portfolio card "Get This Package" buttons
- [ ] **Email Links** - Click mailto links to verify format
- [ ] **Phone Links** - Test tel links on mobile

**Common Issues to Check:**
- Missing `.html` extensions
- Wrong file paths (case sensitivity)
- Broken anchor links (#section-name)
- 404 errors on demo sites

---

### 4. Full Mobile Device Testing
**Status:** Partial (tables tested, full site pending)  
**Device:** Samsung Android, Firefox browser

**Pages to Test:**
- [ ] Home (`index.html`)
- [ ] About (`about.html`) - Verify image positioning
- [ ] Services (`services.html`) - TABLE CRITICAL
- [ ] Portfolio (`portfolio.html`) - Check badge positioning
- [ ] Pricing (`pricing.html`) - TABLE VERIFIED WORKING
- [ ] Process (`process.html`)
- [ ] FAQ (`faq.html`)
- [ ] Contact (`contact.html`)
- [ ] Policies (`policies.html`)

**What to Check:**
- [ ] Images load and display correctly
- [ ] Text is readable (no cut-off, proper sizing)
- [ ] Buttons are tappable (not too small)
- [ ] Forms are usable
- [ ] Navigation menu works
- [ ] Tables display without horizontal scroll
- [ ] Cards stack properly
- [ ] No horizontal page scrolling
- [ ] Footer displays correctly

**Known Issues:**
- VS Code mobile preview is unreliable - always test on actual device
- Tables need specific mobile CSS (pricing and services tables fixed)

---

### 5. Content Proofread
**Status:** Not verified  

**Action Items:**
- [ ] Read through all pages with fresh eyes
- [ ] Check for typos and grammar
- [ ] Verify phone numbers and email addresses are correct
- [ ] Check pricing is accurate and up-to-date
- [ ] Verify timeline estimates (Starter: 3-4 weeks, Growth: 6-8 weeks)
- [ ] Ensure tagline is consistent: "Custom business websites"
- [ ] Check all package descriptions match pricing page

**Pages with Critical Content:**
- Contact info (email, phone)
- Pricing (amounts, timelines)
- Services (package details)
- Policies (legal information)

---

## Nice-to-Have (Can Launch Without, Add Later)

### Analytics & Tracking
**Priority:** Medium  
**Action Items:**
- [ ] Set up Google Analytics 4 account
- [ ] Add GA4 tracking code to all pages
- [ ] Set up goal tracking for form submissions
- [ ] Configure Google Search Console
- [ ] Submit sitemap to Google

**Reference:** See `docs/GOOGLE-ANALYTICS-SETUP.md`

---

### SEO Enhancements
**Priority:** Medium  
**Action Items:**
- [ ] Add meta descriptions to all pages (150-160 characters)
- [ ] Add Open Graph meta tags for social sharing
- [ ] Create `robots.txt` file
- [ ] Create XML sitemap
- [ ] Add structured data (Schema.org) for business info
- [ ] Optimize image alt text for SEO

**Example Meta Tags:**
```html
<meta name="description" content="Professional custom websites for small businesses. Launch in 2-6 weeks with transparent pricing from $2,500.">
<meta property="og:title" content="RV Web Creations - Custom Business Websites">
<meta property="og:description" content="Professional custom websites for small businesses.">
<meta property="og:image" content="https://yoursite.com/images/social-share.jpg">
```

---

### Visual Assets
**Priority:** Low  
**Action Items:**
- [ ] Add favicon (16x16, 32x32, 180x180)
- [ ] Create Apple touch icon (180x180)
- [ ] Add social sharing image (1200x630)
- [ ] Optimize all images (compress without quality loss)

**Reference:** Logo files in `RV Web Creations logos/` folder

---

### Error Pages
**Priority:** Low  
**Action Items:**
- [ ] Create custom 404 error page
- [ ] Create 500 error page (if using server-side code)
- [ ] Test error pages display correctly
- [ ] Add helpful navigation on error pages

---

### Legal & Compliance
**Priority:** Medium  
**Action Items:**
- [ ] Review privacy policy for accuracy
- [ ] Add cookie consent banner if using analytics
- [ ] Ensure contact forms comply with data protection
- [ ] Add SSL certificate (HTTPS)
- [ ] Check terms of service (if applicable)

**Reference:** See `docs/legal-policies-guide.txt`

---

## Launch Readiness Checklist

### Technical
- [ ] All HTML validates (no broken tags)
- [ ] CSS loads correctly on all pages
- [ ] JavaScript has no console errors
- [ ] Forms submit successfully
- [ ] All images load
- [ ] Mobile responsive on target devices
- [ ] Cross-browser testing (Chrome, Firefox, Safari)

### Content
- [ ] No lorem ipsum placeholder text
- [ ] All contact info is accurate
- [ ] Pricing is finalized
- [ ] Legal pages are complete
- [ ] All internal links work
- [ ] External links open in new tabs

### Performance
- [ ] Page load time under 3 seconds
- [ ] Images are optimized
- [ ] No render-blocking resources
- [ ] Mobile performance acceptable

### Security
- [ ] Forms have spam protection
- [ ] PHP handlers sanitize inputs
- [ ] File permissions are secure
- [ ] HTTPS enabled (SSL certificate)

---

## Known Issues & Solutions

### Issue: Mobile Tables Cutting Off
**Status:** FIXED (Dec 12, 2025)  
**Pages Affected:** Pricing, Services  
**Solution:** 
- Removed Bootstrap `.table-responsive` wrapper
- Added custom mobile CSS with tight spacing
- Services table uses 0.65rem font for 4 columns
- Pricing table uses 0.75rem font for 3 columns

**Commits:**
- Pricing: `52ec855` - Restored working version from commit `9469089`
- Services: `7f659b1` - Applied mobile CSS fix

---

### Issue: VS Code Mobile Preview Unreliable
**Status:** KNOWN LIMITATION  
**Solution:** Always test on actual Samsung Android device using Spck Editor workflow
**Workflow:**
1. Make changes on Mac
2. Copy files to Android phone
3. Import into Spck Editor app
4. Test in Samsung Android Firefox browser

---

### Issue: About Page Image Cut-Off on Mobile
**Status:** FIXED (Dec 12, 2025)  
**Solution:** 
- Moved image above heading on mobile
- Added `object-fit: cover` and `object-position: center top`
- Image now visible immediately on page load

---

## Post-Launch Tasks

### Week 1
- [ ] Monitor form submissions
- [ ] Check analytics setup
- [ ] Review any error reports
- [ ] Test all links again
- [ ] Monitor page load speeds

### Month 1
- [ ] Review analytics data
- [ ] Identify high-bounce pages
- [ ] Gather user feedback
- [ ] Make content adjustments
- [ ] Optimize underperforming pages

### Ongoing
- [ ] Regular content updates
- [ ] Security updates (if using CMS)
- [ ] Performance monitoring
- [ ] SEO improvements
- [ ] A/B testing CTAs

---

## Contact for Issues

**Developer:** GitHub Copilot + Ryan Via  
**Project Repository:** https://github.com/b36strad/rv-web-creations  
**Last Major Update:** December 12, 2025

---

## Quick Reference: Recent Changes

**December 12, 2025 Session:**
1. ✅ Services page mobile table fixed
2. ✅ About page image repositioned for mobile
3. ✅ Home page process section callouts redesigned (removed blue)
4. ✅ About page cards updated (added borders and icons)
5. ✅ Portfolio page badges standardized (all blue except green industry variations)
6. ✅ Portfolio badges repositioned (bottom-right for industry variations)
7. ✅ Contact form submit button centered
8. ✅ Professional Services card badge color standardized

**See:** `docs/CHANGELOG-2025-12-12.md` for complete details

---

## Emergency Rollback

If critical issues found after launch:

```bash
# View recent commits
git log --oneline | head -10

# Rollback to specific commit
git reset --hard <commit-hash>

# Force push (USE WITH CAUTION)
git push origin main --force
```

**Known Good Commits:**
- `9469089` - Last working pricing table (Session 2, Dec 11)
- `52ec855` - Pricing table restored (Dec 12)
- `7f659b1` - Services table fixed (Dec 12)

---

**Last Updated:** December 12, 2025  
**Next Review:** Before launch

