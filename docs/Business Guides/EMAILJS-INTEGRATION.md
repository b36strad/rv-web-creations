# EmailJS Integration for Pricing Calculator

This file explains how to enable the email estimate feature on your pricing page using EmailJS.

## 1. Sign Up for EmailJS
- Go to https://www.emailjs.com/ and create a free account.

## 2. Add EmailJS to Your Project
- The following code is already included in your pricing.html:

```html
<!-- EmailJS SDK -->
<script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
<script>
  (function(){
    emailjs.init('YOUR_USER_ID'); // Replace with your EmailJS user ID
  })();
</script>
```

## 3. Create a Service and Email Template
- In the EmailJS dashboard:
  1. Add an email service (e.g., Gmail, Outlook, or custom SMTP).
  2. Create a new email template. Use these variables in your template:
    - `from_name`
    - `from_email`
    - `message`

## 4. Update Your JavaScript
- In `src/js/pricing-calculator.js`, replace the placeholders in the email sending code:
  - `YOUR_SERVICE_ID`
  - `YOUR_TEMPLATE_ID`
  - `YOUR_USER_ID`
- Example:

```js
emailjs.send('service_xxx', 'template_xxx', {
  from_name: name,
  from_email: email,
  message: summary
}, 'user_xxx')
```

## 5. Test the Form
- Fill out the calculator and the email form, then click "Send Estimate."
- You and the user should receive the estimate by email.

## 6. CRM Integration (Optional)
- You can use EmailJS to send a copy to your CRM's lead capture email address, or use Zapier/Make to automate CRM entry.

## Troubleshooting
- If emails are not sent, check your EmailJS dashboard for errors.
- Make sure your user ID, service ID, and template ID are correct.
- For advanced logic, see the EmailJS docs: https://www.emailjs.com/docs/

---

For further help, contact your developer or EmailJS support.
