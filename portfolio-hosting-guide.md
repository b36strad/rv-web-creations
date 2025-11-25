# Portfolio Hosting Options Guide

## Overview
This guide explains the best ways to host additional projects and showcase them in your portfolio.

## Hosting Options

### GitHub Pages (Best for Static Sites)
- **URL:** `b36strad.github.io/rv-web-creations`
- **Cost:** Free
- **Setup:** Enable in repo settings → Pages
- **Features:**
  - Free hosting
  - Custom domain support
  - SSL included
  - Perfect for HTML/CSS/JS sites
- **Limitations:**
  - No server-side processing (PHP won't work)
  - Your `contact-handler.php` and `intake-handler.php` won't function

### Netlify (Recommended for This Project)
- **Cost:** Free tier available
- **Features:**
  - Built-in form handling (replaces PHP forms)
  - Drag & drop or Git integration
  - Custom domains included
  - Free SSL certificates
  - Continuous deployment from GitHub
  - Serverless functions support
- **Best For:** Your site with contact forms
- **Setup:** Connect GitHub repo, deploy instantly

### Vercel
- **Cost:** Free tier available
- **Features:**
  - Similar to Netlify
  - Excellent performance and speed
  - Git integration
  - Custom domains
  - Serverless functions
- **Best For:** Modern web projects, fast deployment

### Traditional Web Hosting (If PHP is Required)
- **Providers:** HostGator, Bluehost, SiteGround
- **Cost:** $3-10/month
- **Features:**
  - Full PHP support
  - MySQL databases
  - cPanel management
  - Email hosting
- **Best For:** Projects requiring server-side processing

## Adding Projects to Your Portfolio

### Option 1: Projects Folder Structure
```
rv-web-creations/
├── src/
│   ├── portfolio.html
│   └── ...
├── projects/
│   ├── project-1/
│   │   ├── index.html
│   │   ├── css/
│   │   └── js/
│   ├── project-2/
│   │   ├── index.html
│   │   └── ...
│   └── project-3/
```

### Option 2: Separate Repositories
- Create individual repos for each project
- Host each on GitHub Pages or Netlify
- Link to live demos from your portfolio page
- Example: `b36strad.github.io/project-name`

### Option 3: Embed in Portfolio Page
- Add project details directly to `portfolio.html`
- Include screenshots, descriptions, tech stack
- Link to GitHub repos and live demos

## Recommended Workflow

1. **Main Portfolio Site:** Deploy to Netlify
   - Use Netlify Forms for contact functionality
   - Connect to this GitHub repo for auto-deployment

2. **Individual Projects:**
   - Create separate repos for each project
   - Deploy each to GitHub Pages
   - Link from your main portfolio

3. **Update Process:**
   - Push changes to GitHub
   - Netlify auto-deploys your main site
   - GitHub Pages auto-deploys individual projects

## Next Steps

### To Deploy on Netlify:
1. Go to netlify.com
2. Sign up/login with GitHub
3. Click "Add new site" → "Import an existing project"
4. Connect your `rv-web-creations` repo
5. Configure build settings:
   - Build command: (leave empty)
   - Publish directory: `src`
6. Deploy site

### To Enable GitHub Pages:
1. Go to your repo on GitHub
2. Settings → Pages
3. Source: Deploy from branch `main`
4. Folder: `/src` or `/root`
5. Save

### To Set Up Projects Folder:
Let me know and I can create the folder structure for you.
