# 🚀 Deploy Templates to Netlify - Quick Start Guide

## Option 1: Drag & Drop Deployment (Easiest - 5 minutes)

### Step 1: Prepare Starter Template
The Starter template needs the base CSS files copied locally. Run these commands:

```bash
cd "/Users/ryanvia/Documents/Projects/RV Web Creations/templates/starter"

# Copy base CSS files
cp ../_base/css/variables.css css/
cp ../_base/css/utilities.css css/
```

Then update the HTML files to use local CSS instead of ../_base/css/

### Step 2: Deploy to Netlify

1. **Go to**: https://app.netlify.com
2. **Sign in** (or create free account with GitHub)
3. **Click**: "Add new site" → "Deploy manually"
4. **Drag the entire `starter` folder** into the upload area
5. **Wait 30 seconds** - your site is live!
6. **Get your URL**: `https://[random-name].netlify.app`

### Step 3: Customize URL (Optional)
- Click "Site settings"
- Click "Change site name"
- Enter: `rvweb-starter-demo`
- Your new URL: `https://rvweb-starter-demo.netlify.app`

### Step 4: Repeat for Growth Template
- Same process with `/templates/growth` folder
- Name it: `rvweb-growth-demo`

---

## Option 2: GitHub + Netlify (Automatic Updates)

### Step 1: Push templates to GitHub
Already done! Your templates are at: `github.com/b36strad/rv-web-creations/tree/main/templates`

### Step 2: Connect Netlify to GitHub

1. **Go to**: https://app.netlify.com
2. **Click**: "Add new site" → "Import an existing project"
3. **Choose**: GitHub
4. **Select**: `rv-web-creations` repository
5. **Configure**:
   - **Base directory**: `templates/starter`
   - **Build command**: (leave empty)
   - **Publish directory**: `.` (just a dot)
6. **Deploy!**

### Step 3: Create Second Site for Growth
- Repeat process
- Base directory: `templates/growth`

**Benefit**: Every time you push to GitHub, Netlify auto-updates your demos!

---

## 📝 After Deployment Checklist

### 1. Test Your Live Demos
- [ ] Visit both demo URLs
- [ ] Check all pages load (Home, About, Services, Contact)
- [ ] Test navigation links
- [ ] Verify demo banner displays
- [ ] Test "Get This Template" button (should email info@rvwebcreations.com)
- [ ] Check mobile responsiveness

### 2. Update Portfolio Page
Add live demo URLs to `/src/portfolio.html`:

```html
<!-- Replace the # links with your actual Netlify URLs -->
<a href="https://rvweb-starter-demo.netlify.app" class="btn btn-primary" target="_blank">
  View Live Demo
</a>

<a href="https://rvweb-growth-demo.netlify.app" class="btn btn-primary" target="_blank">
  View Live Demo
</a>
```

### 3. Share Your Demos
- [ ] Add to email signature
- [ ] Share on LinkedIn
- [ ] Include in proposals
- [ ] Add to contact page
- [ ] Update README

---

## 🔧 Quick Fix: CSS Path Issues

If your deployed site has styling issues, it's because of the `../_base/css/` references.

### Fix for Starter Template:

**In ALL HTML files (index.html, about.html, services.html, contact.html):**

Change:
```html
<link rel="stylesheet" href="../_base/css/variables.css">
<link rel="stylesheet" href="../_base/css/utilities.css">
```

To:
```html
<link rel="stylesheet" href="css/variables.css">
<link rel="stylesheet" href="css/utilities.css">
```

Then make sure `variables.css` and `utilities.css` exist in `templates/starter/css/` folder.

---

## 🎯 Expected Demo URLs

After deployment, you'll have:
- **Starter Demo**: `https://rvweb-starter-demo.netlify.app`
- **Growth Demo**: `https://rvweb-growth-demo.netlify.app`

These are the links you'll add to your portfolio page and share with prospects!

---

## 💡 Pro Tips

1. **Custom Domain**: Point `starter.rvwebcreations.com` to your Netlify site (requires domain setup)
2. **Analytics**: Add your Google Analytics ID to track visits
3. **Forms**: Update contact forms to use Netlify Forms (free, no backend needed)
4. **SSL**: Automatically included - your demos are secure!
5. **Updates**: Make changes locally → push to GitHub → auto-deploys!

---

## 🆘 Troubleshooting

**Demo looks broken?**
- Check browser console for CSS/JS errors
- Most likely: CSS path issues (see Quick Fix section above)

**Changes not showing?**
- Clear browser cache (Cmd+Shift+R on Mac)
- Check Netlify deploy log for errors

**Want to update demo?**
- Drag and drop the updated folder again
- Or use GitHub auto-deploy method

---

Ready to deploy? Start with Option 1 (drag & drop) - it's the fastest way to get your demos live!
