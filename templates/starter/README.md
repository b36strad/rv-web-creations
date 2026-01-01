# Starter Template

A clean, professional 4-page Bootstrap 5 template perfect for small business websites.

**Price Range**: $2,500 - $6,000  
**Typical Timeline**: 2-3 weeks (15-25 hours of work)  
**Best For**: Small local businesses, service providers, consultants

---

## 📋 Template Contents

### Pages Included (4)
1. **Home** (`index.html`) - Hero, features, services preview, testimonials, CTA
2. **About** (`about.html`) - Company story, mission & values, team, stats
3. **Services** (`services.html`) - Service details, process, pricing, FAQ
4. **Contact** (`contact.html`) - Contact form, info, map, quick answers

### Assets
- `css/styles.css` - Custom styles with CSS variables
- `js/main.js` - Interactive functionality
- `images/` - Placeholder folder for client images

### Dependencies
- Bootstrap 5.3.0 (CDN)
- Bootstrap Icons 1.11.0 (CDN)
- Base template resources (`../_base/`)

---

## 🚀 Quick Start Guide

### 1. Copy Template to New Project

```bash
# Create new client project folder
mkdir client-project-name
cd client-project-name

# Copy starter template
cp -r templates/starter/* .
cp -r templates/_base .
```

### 2. Customize Branding

**Update CSS Variables** in `css/styles.css`:

```css
:root {
  --color-primary: #007bff;      /* Client's primary brand color */
  --color-primary-light: #3395ff;
  --color-primary-dark: #0056b3;
  --color-accent: #28a745;        /* Client's accent color */
}
```

**Replace Placeholders** in all HTML files:
- `[CLIENT NAME]` → Client business name
- `[CLIENT LOGO]` → Logo image or text
- `[Business Address]` → Physical address
- `[Phone Number]` → Contact phone
- `[Email Address]` → Contact email
- `[Hours]` → Business hours
- All `[Bracketed text]` → Actual content

### 3. Add Client Content

1. **Images**: Replace placeholder images in `images/` folder
   - `hero-image.jpg` (1920x1080px recommended)
   - `about-story.jpg` (1200x800px)
   - `service-1.jpg`, `service-2.jpg`, `service-3.jpg` (800x600px)
   - `team-member-1.jpg`, `team-member-2.jpg`, `team-member-3.jpg` (300x300px)
   - `favicon.ico`

2. **Text Content**: Update all bracketed content with client-specific information

3. **Social Links**: Update footer social media links (or remove if not needed)

4. **Google Maps**: Update iframe src in `contact.html` with actual location

### 4. Configure Contact Form

Update form action in `contact.html`:

```html
<form action="contact-handler.php" method="POST">
```

Options:
- Use your existing `contact-handler.php` from main site
- Create new handler specific to this project
- Use third-party service (Formspree, Netlify Forms, etc.)

### 5. Test Locally

```bash
# Option 1: Python simple server
python3 -m http.server 8000

# Option 2: PHP built-in server
php -S localhost:8000

# Option 3: VS Code Live Server extension
# Right-click index.html → "Open with Live Server"
```

Visit: http://localhost:8000

---

## 🎨 Customization Options

### Change Font

Add Google Fonts in `css/styles.css`:

```css
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
  --font-primary: 'Poppins', sans-serif;
  --font-heading: 'Poppins', sans-serif;
}
```

### Adjust Spacing

Modify section padding in `../_base/css/variables.css`:

```css
:root {
  --spacing-3xl: 4rem;  /* Increase/decrease section padding */
  --spacing-4xl: 6rem;
}
```

### Change Button Style

In `css/styles.css`:

```css
.btn {
  border-radius: 50px;  /* Make buttons more rounded */
}
```

### Add More Pages

Copy `about.html` as template:

```bash
cp about.html new-page.html
```

Update:
1. Page title and meta description
2. Active nav link
3. Header content
4. Main content sections

---

## 📱 Responsive Design

Template is fully responsive with breakpoints:
- **Mobile**: < 576px
- **Tablet**: 576px - 991px  
- **Desktop**: 992px+

All components adapt automatically via Bootstrap's grid system.

---

## ✅ Pre-Launch Checklist

### Content
- [ ] Replace all `[PLACEHOLDER]` text
- [ ] Add all client images (optimized for web)
- [ ] Update meta descriptions for SEO
- [ ] Add favicon
- [ ] Test all internal links

### Branding
- [ ] Update CSS color variables
- [ ] Add client logo
- [ ] Update font if needed
- [ ] Match client's brand guidelines

### Contact
- [ ] Test contact form submission
- [ ] Verify email delivery
- [ ] Update Google Maps location
- [ ] Add correct phone/email links
- [ ] Update business hours

### Technical
- [ ] Test on mobile devices
- [ ] Test in Chrome, Firefox, Safari
- [ ] Validate HTML (https://validator.w3.org/)
- [ ] Check page load speed
- [ ] Set up SSL certificate
- [ ] Configure hosting
- [ ] Set up analytics (Google Analytics)

### Legal
- [ ] Add privacy policy (if collecting form data)
- [ ] Add terms of service (if needed)
- [ ] Ensure GDPR/accessibility compliance

---

## 🔧 Common Modifications

### Remove Team Section

If client doesn't want team displayed, remove from `about.html`:

```html
<!-- Team Section -->
<section class="section-padding">
  ... entire section ...
</section>
```

### Remove Pricing Section

If client prefers custom quotes only, remove from `services.html`:

```html
<!-- Pricing Section -->
<section class="section-padding">
  ... entire section ...
</section>
```

### Add Email Newsletter Signup

Add to footer in all HTML files:

```html
<div class="col-lg-4">
  <h6 class="mb-3">Newsletter</h6>
  <form action="newsletter-handler.php" method="POST">
    <div class="input-group">
      <input type="email" class="form-control" placeholder="Your email" required>
      <button type="submit" class="btn btn-primary">Subscribe</button>
    </div>
  </form>
</div>
```

### Change Hero Background

Replace gradient with image in `index.html`:

```html
<section class="hero min-h-75vh d-flex align-items-center text-white" 
         style="background: url('images/hero-bg.jpg') center/cover no-repeat;">
  <div class="overlay overlay-dark"></div>
  <!-- Content -->
</section>
```

---

## 🐛 Troubleshooting

### Form Not Submitting
- Check `contact-handler.php` exists and is configured
- Verify PHP is running (if using PHP handler)
- Check browser console for JavaScript errors

### Animations Not Working
- Verify `../_base/js/common.js` is loaded
- Check browser console for errors
- Ensure Bootstrap JS is loaded before custom scripts

### Images Not Loading
- Check file paths are correct (case-sensitive on Linux servers)
- Ensure images are in `images/` folder
- Verify image file extensions match HTML references

### Mobile Menu Not Closing
- Ensure Bootstrap JS is loaded (required for collapse)
- Check browser console for errors

---

## 📊 Performance Tips

1. **Optimize Images**: Use WebP format, compress before upload
2. **Enable Caching**: Configure server to cache CSS/JS/images
3. **Minify CSS/JS**: Use build tools for production
4. **Use CDN**: Bootstrap already on CDN, consider images too
5. **Lazy Load Images**: Already implemented in template

---

## 🆙 Upgrade Path

Client needs more features? Consider upgrading to:

- **Growth Template**: 8-15 pages, blog, advanced features
- **Custom Build**: Unique design, custom functionality

---

## 📞 Support

For technical issues or customization questions:
- Review base template docs: `../_base/README.md`
- Check Bootstrap docs: https://getbootstrap.com/docs/5.3/
- Internal support: [Your contact method]

---

**Template Version**: 1.0.0  
**Last Updated**: November 30, 2025  
**Bootstrap Version**: 5.3.0
