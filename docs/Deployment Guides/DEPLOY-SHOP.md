# Deploy Shop Template to Netlify

Quick guide to deploy the Shop template as a live demo.

## Step 1: Prepare Product Images

Before deploying, add placeholder product images to `templates/shop/images/`:

You can use free images from Unsplash:
- **Product Hero**: https://images.unsplash.com/photo-1556742049-0cfed4f6a45d
- **Product Main**: https://images.unsplash.com/photo-1505740420928-5e560c06d30e
- **Gallery Images**: Search for product photos relevant to your demo

Or create simple placeholder images with text overlays using:
- Canva.com
- Photopea.com (free Photoshop alternative)
- Or use solid color backgrounds with "Demo Image" text

## Step 2: Update index.html

Replace image sources in `templates/shop/index.html`:

```html
<!-- Change from: -->
<img src="images/product-hero.jpg" alt="Product Name">

<!-- To use online images temporarily: -->
<img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&h=800&fit=crop&q=80" alt="Product Name">
```

## Step 3: Add Demo Banner

Add this banner at the top of the page (after `<body>`):

```html
<!-- Demo Banner -->
<div class="demo-banner" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; padding: 15px 0; position: sticky; top: 0; z-index: 1050; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-auto">
        <p class="mb-0">
          <i class="bi bi-star-fill me-2"></i>
          <strong>Live Demo:</strong> Shop Template - Starting at $2,500
        </p>
      </div>
      <div class="col-auto">
        <a href="mailto:info@rvwebcreations.com?subject=Interested in Shop Template" class="btn btn-light btn-sm">
          Get This Template <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>
    </div>
  </div>
</div>
```

## Step 4: Customize Placeholder Content

Find and replace all bracketed placeholders:
- `[PRODUCT NAME]` → "Amazing Product" (or any demo product)
- `[LOGO]` → "Demo Shop"
- `[XX.XX]` → "$99.99" (example pricing)
- `[email@example.com]` → "info@rvwebcreations.com"
- `[Description]` → Add realistic demo text

## Step 5: Deploy to Netlify

1. **Go to Netlify**: https://app.netlify.com/
2. **Click**: "Add new site" → "Deploy manually"
3. **Drag the folder**: `templates/shop/` (the entire folder)
4. **Wait**: For deployment to complete
5. **Rename site**: 
   - Click "Site settings"
   - Click "Change site name"
   - Enter: `rvweb-shop-demo`
   - Your URL: `https://rvweb-shop-demo.netlify.app`

## Step 6: Update Portfolio Link

After deployment, update the portfolio page:

In `src/portfolio.html`, change the Shop template "View Live Demo" link from:
```html
<a href="#" class="btn btn-primary">
```

To:
```html
<a href="https://rvweb-shop-demo.netlify.app" class="btn btn-primary" target="_blank" rel="noopener">
```

## Step 7: Test the Demo

Visit your live demo and test:
- [ ] Navigation links work
- [ ] Product images display correctly
- [ ] Image gallery thumbnail clicks work
- [ ] Quantity +/- buttons work
- [ ] Product option selectors work
- [ ] "Add to Cart" shows the integration message
- [ ] All accordion FAQ items expand
- [ ] Smooth scrolling works
- [ ] Email button opens (demo banner)
- [ ] Mobile responsive design

## Quick Demo Content Ideas

**Example Product**: Handcrafted Leather Wallet

**Hero Description**:
> "Premium handcrafted leather wallet made from genuine Italian leather. Features RFID protection, 8 card slots, and a slim design that fits comfortably in any pocket."

**Price**: $79.99 (was $99.99, save 20%)

**Features**:
- Genuine Italian leather construction
- RFID blocking technology
- Holds 8+ cards plus cash
- Slim 0.5" profile design

**Reviews**: Create 2-3 realistic customer reviews

**Colors**: Black, Brown, Tan

**Sizes**: Standard, Compact, XL

## Alternative: Use Real Client Product

If you have a client with a product, use their:
- Actual product photos
- Real product name and description
- Actual pricing
- Real customer reviews (if available)

This makes the demo more authentic and can serve as a portfolio piece.

## Payment Integration Note

The demo includes a placeholder "Add to Cart" function. For a real implementation, you'd integrate:

- **Stripe**: Best for most products
- **PayPal**: Great for international
- **Gumroad**: Easy for digital products
- **Shopify**: For inventory management

Add note in demo banner or footer:
> "This is a demo template. Payment integration available with Stripe, PayPal, or Shopify."

## After Deployment

1. **Update portfolio**: Add the live demo link
2. **Share**: Use the demo in client proposals
3. **Promote**: Share on LinkedIn/social media
4. **Track**: Add Google Analytics to track visits

## Troubleshooting

**Images not loading?**
- Use absolute URLs from Unsplash temporarily
- Or ensure images folder is included in deployment

**Styles not working?**
- Check that css/ folder is included
- Verify all CDN links are working (Bootstrap, Icons)

**JavaScript errors?**
- Open browser console (F12) to check for errors
- Verify js/main.js is included

---

**Need help?** Email: info@rvwebcreations.com
