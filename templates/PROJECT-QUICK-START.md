# Quick Start: New Client Project

**Use this checklist every time you start a new client project**

---

## 🎯 Step 1: Choose Template (2 minutes)

Based on pricing calculator results and intake form:

- [ ] **Starter** ($2,500-6k) → 4-6 pages, simple site
- [ ] **Growth** ($7,500-18k) → 8-15 pages, blog/portfolio
- [ ] **Custom** ($18k+) → Unique requirements

---

## 📋 Step 2: Gather Client Info (Before coding)

Make sure you have:

- [ ] Client business name
- [ ] Logo (PNG with transparent background preferred)
- [ ] Brand colors (hex codes)
- [ ] All page content written (or lorem ipsum placeholders)
- [ ] Client images (optimized for web)
- [ ] Contact information (address, phone, email, hours)
- [ ] Social media links
- [ ] Google Maps location (or address for embed)
- [ ] Domain name and hosting access

---

## 💻 Step 3: Set Up Project (5 minutes)

```bash
# Navigate to projects folder
cd ~/Documents/Projects

# Create new client folder
mkdir "ClientName-Website"
cd "ClientName-Website"

# Copy chosen template (example: starter)
cp -r ../RV\ Web\ Creations/templates/starter/* .
cp -r ../RV\ Web\ Creations/templates/_base .

# Initialize Git repository
git init
git add .
git commit -m "Initial commit: Starter template setup"

# Open in VS Code
code .
```

---

## 🎨 Step 4: Customize Branding (15 minutes)

### Update CSS Variables
Open `css/styles.css` and update:

```css
:root {
  --color-primary: #[CLIENT-PRIMARY-COLOR];
  --color-primary-light: #[LIGHTER-VERSION];
  --color-primary-dark: #[DARKER-VERSION];
  --color-accent: #[CLIENT-ACCENT-COLOR];
}
```

**Pro tip**: Use https://coolors.co to generate color shades

### Update All HTML Files
Find and replace (Cmd/Ctrl + Shift + F in VS Code):

1. `[CLIENT NAME]` → Client's business name
2. `[CLIENT LOGO]` → `<img src="images/logo.png" alt="ClientName">`
3. `[Business Address]` → Full address
4. `[Phone Number]` → (555) 123-4567
5. `[Email Address]` → contact@client.com
6. `[Hours]` → Operating hours

---

## 📝 Step 5: Add Content (2-8 hours)

### For Each Page:

1. **Update page title and meta description**
   ```html
   <title>ClientName | Page Title</title>
   <meta name="description" content="Specific page description">
   ```

2. **Replace bracketed content** with actual text

3. **Update section headings** to be specific

4. **Remove optional sections** if not needed
   - Team section (about.html)
   - Pricing section (services.html)
   - Stats section (about.html)

### Content Priority Order:
1. Home page (most important)
2. Services page
3. Contact page
4. About page

---

## 🖼️ Step 6: Add Images (1-2 hours)

### Required Images:

Place in `images/` folder:

- [ ] `favicon.ico` (32x32px)
- [ ] `logo.png` (recommended: 200px height, transparent background)
- [ ] `hero-image.jpg` (1920x1080px)
- [ ] `about-story.jpg` (1200x800px)
- [ ] `service-1.jpg` (800x600px)
- [ ] `service-2.jpg` (800x600px)
- [ ] `service-3.jpg` (800x600px)

Optional (if using team section):
- [ ] `team-member-1.jpg` (300x300px, square)
- [ ] `team-member-2.jpg` (300x300px, square)
- [ ] `team-member-3.jpg` (300x300px, square)

**Before uploading**: Optimize with https://tinypng.com or ImageOptim

---

## 🔧 Step 7: Configure Functionality (30 minutes)

### Contact Form Setup

**Option A: Use existing handler** (recommended)
```html
<form action="https://rvwebcreations.com/contact-handler.php" method="POST">
```

**Option B: Third-party service**
- Formspree: https://formspree.io
- Netlify Forms: Built-in if hosting on Netlify
- SendGrid: For custom email handling

### Google Maps

1. Go to https://www.google.com/maps
2. Search for client address
3. Click "Share" → "Embed a map"
4. Copy iframe code
5. Replace in `contact.html`

### Analytics

Add before closing `</head>` in all HTML files:

```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX');
</script>
```

---

## 🧪 Step 8: Test Everything (1 hour)

### Local Testing

Start local server:
```bash
# Python
python3 -m http.server 8000

# OR PHP
php -S localhost:8000

# OR use VS Code Live Server extension
```

### Test Checklist:

**Desktop (Chrome, Firefox, Safari)**
- [ ] All internal links work
- [ ] All external links open in new tab
- [ ] Contact form submits successfully
- [ ] No console errors (F12 → Console)
- [ ] Images load properly
- [ ] Smooth scrolling works
- [ ] Mobile menu toggles

**Mobile (iPhone, Android)**
- [ ] Layout is responsive
- [ ] Text is readable (not too small)
- [ ] Buttons are tappable
- [ ] Forms work on mobile
- [ ] Navigation menu works
- [ ] Images fit screen

**Forms**
- [ ] Submit with valid data → success
- [ ] Submit with invalid data → shows errors
- [ ] Required fields enforce validation
- [ ] Email validation works
- [ ] Receive test email

**Performance**
- [ ] Run PageSpeed Insights: https://pagespeed.web.dev/
- [ ] Target score: 90+ mobile, 95+ desktop
- [ ] Fix any critical issues

---

## 🚀 Step 9: Deploy to Staging (30 minutes)

### Option A: Netlify (Easiest)
```bash
# Install Netlify CLI
npm install -g netlify-cli

# Deploy
netlify deploy
```

### Option B: FTP/SFTP
1. Use FileZilla or Cyberduck
2. Connect to client's hosting
3. Upload all files to public_html or www folder
4. Test at staging URL

### Option C: cPanel
1. Log into cPanel
2. Go to File Manager
3. Upload files to public_html
4. Extract if zipped

### Share with Client
- [ ] Send staging URL
- [ ] Request feedback
- [ ] Set deadline for revisions

---

## 🔄 Step 10: Revisions (2-4 hours)

### Typical Revision Process:

1. **Receive feedback** → Document all changes needed
2. **Prioritize** → Separate "must have" from "nice to have"
3. **Implement** → Make changes systematically
4. **Test** → Ensure nothing broke
5. **Re-deploy** → Push to staging for re-review

**Pro tip**: Limit to 2 revision rounds in your contract

---

## ✅ Step 11: Pre-Launch Final Check (30 minutes)

- [ ] All content finalized and approved by client
- [ ] All images optimized and displaying correctly
- [ ] Contact form tested and working
- [ ] All links checked (no 404s)
- [ ] SEO meta tags completed
- [ ] Favicon showing in browser tab
- [ ] Analytics tracking code installed
- [ ] SSL certificate configured (https://)
- [ ] 404 error page exists
- [ ] Test on multiple devices/browsers
- [ ] Run accessibility check: https://wave.webaim.org/
- [ ] Run HTML validator: https://validator.w3.org/
- [ ] Page load speed acceptable (<3 seconds)

---

## 🎉 Step 12: Launch (1 hour)

### Deploy to Production

1. **Point domain** to hosting (if not already)
2. **Upload final files** to production server
3. **Test live site** thoroughly
4. **Submit to Google**: https://search.google.com/search-console
5. **Set up monitoring**: UptimeRobot or Pingdom

### Client Handoff

Send client:
- [ ] Live website URL
- [ ] Login credentials (hosting, CMS if applicable)
- [ ] Basic how-to guide for common updates
- [ ] Analytics dashboard access
- [ ] Invoice via Moxie

---

## 📊 Step 13: Post-Launch (30 minutes)

- [ ] Add project to portfolio (with client permission)
- [ ] Request testimonial from client
- [ ] Set up monthly maintenance in Moxie (if applicable)
- [ ] Schedule 30-day follow-up check-in
- [ ] Archive project files locally
- [ ] Update project tracking system
- [ ] Celebrate! 🎉

---

## ⏱️ Time Tracking by Template

### Starter Template (15-25 hours total)
- Setup & branding: 2-3 hours
- Content & images: 4-8 hours
- Functionality: 1-2 hours
- Testing: 1-2 hours
- Revisions: 2-4 hours
- Launch: 1-2 hours
- Client meetings: 4-6 hours

### Growth Template (30-60 hours total)
- Setup & branding: 3-5 hours
- Content & images: 10-20 hours
- Functionality: 3-6 hours
- Testing: 2-4 hours
- Revisions: 4-8 hours
- Launch: 2-3 hours
- Client meetings: 6-12 hours

---

## 🆘 Quick Troubleshooting

**Images not showing?**
→ Check file paths are correct and case matches

**Form not working?**
→ Check handler URL, verify POST method, test PHP is enabled

**Mobile menu not opening?**
→ Ensure Bootstrap JS is loaded, check browser console for errors

**Styles not applying?**
→ Clear browser cache, verify CSS file path, check for typos in CSS

**Site loads slowly?**
→ Optimize images with TinyPNG, enable caching, use CDN

---

## 📞 Need Help?

- Review template README: `templates/[template-name]/README.md`
- Check base docs: `templates/_base/README.md`
- Bootstrap docs: https://getbootstrap.com/docs/5.3/

---

**Keep this file handy for every new project!**

Save time by following this process consistently.
