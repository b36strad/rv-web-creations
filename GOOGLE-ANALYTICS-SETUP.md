# Google Analytics Setup Instructions

## Step 1: Create Google Analytics Account

1. Go to https://analytics.google.com/
2. Sign in with your Google account
3. Click "Start measuring"
4. Enter Account Name: **RV Web Creations**
5. Click "Next"

## Step 2: Create Property

1. Property Name: **RV Web Creations Website**
2. Reporting Time Zone: Select your timezone
3. Currency: USD
4. Click "Next"

## Step 3: Configure Business Details

1. Industry Category: **Technology** or **Business Services**
2. Business Size: **Small (1-10 employees)**
3. How you plan to use Google Analytics: Check relevant boxes
   - Examine user behavior
   - Measure advertising ROI
4. Click "Create"

## Step 4: Accept Terms of Service

1. Select your country: **United States**
2. Read and accept the Terms of Service
3. Click "I Accept"

## Step 5: Set Up Data Stream

1. Choose platform: **Web**
2. Website URL: **https://www.rvwebcreations.com** (or your actual domain)
3. Stream name: **RV Web Creations Main Site**
4. Click "Create stream"

## Step 6: Get Your Measurement ID

1. After creating the stream, you'll see your **Measurement ID**
   - Format: `G-XXXXXXXXXX`
2. **Copy this ID** - you'll need it in the next step

## Step 7: Add Tracking Code to Your Website

You need to replace `YOUR_MEASUREMENT_ID` in ALL HTML files with your actual Measurement ID.

### Files that need updating:
```
src/index.html
src/about.html
src/services.html
src/portfolio.html
src/process.html
src/pricing.html
src/faq.html
src/contact.html
src/project-intake.html
src/policies.html
```

### What to replace:
**Find this in each file:**
```html
<script async src="https://www.googletagmanager.com/gtag/js?id=YOUR_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'YOUR_MEASUREMENT_ID');
</script>
```

**Replace `YOUR_MEASUREMENT_ID` with your actual ID. Example:**
```html
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABC123XYZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-ABC123XYZ');
</script>
```

## Step 8: Test Your Setup

1. After adding your Measurement ID to all pages, upload your site to your hosting
2. Visit your website
3. Go back to Google Analytics
4. Click on "Reports" → "Realtime"
5. You should see yourself as an active user within 30 seconds

## Step 9: Set Up Important Events (Optional but Recommended)

### Track Contact Form Submissions

In your `contact-handler.php` and `intake-handler.php`, add this after successful form submission:

```javascript
gtag('event', 'contact_form_submit', {
  'form_type': 'contact' // or 'intake'
});
```

### Track "Get a Quote" Button Clicks

Add to your main.js or inline on buttons:

```javascript
document.querySelectorAll('[href="contact.html"]').forEach(button => {
  button.addEventListener('click', function() {
    gtag('event', 'cta_click', {
      'button_text': 'Get Your Free Quote'
    });
  });
});
```

## What to Monitor

Once live, check these metrics weekly:

1. **Users** - How many people visit your site
2. **Pages per session** - Are visitors exploring multiple pages?
3. **Bounce rate** - Are visitors leaving immediately?
4. **Traffic sources** - Where are visitors coming from?
5. **Conversions** - Contact form submissions

## Important Notes

- Analytics data takes 24-48 hours to fully populate
- You won't see historical data - only data from when you installed the code forward
- Keep your Measurement ID private (don't share publicly)
- Install BEFORE launching to capture data from day one

## Need Help?

- Google Analytics Help Center: https://support.google.com/analytics
- Video Tutorial: Search YouTube for "Google Analytics 4 setup tutorial"
