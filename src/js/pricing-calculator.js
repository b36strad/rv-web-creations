// Full-featured pricing calculator logic
document.addEventListener('DOMContentLoaded', function () {
      // Utility to enable/disable add-ons based on base package
      function updateAddonAvailability() {
        const baseKey = form.elements['base_package'].value;
        const blogSetup = form.querySelector('input#blog_setup');
        const contentMigration = form.querySelector('input#content_migration');
        if (blogSetup && contentMigration) {
          if (baseKey === 'starter') {
            blogSetup.disabled = false;
            contentMigration.disabled = false;
          } else {
            blogSetup.checked = false;
            blogSetup.disabled = true;
            contentMigration.checked = false;
            contentMigration.disabled = true;
          }
        }
      }
    // Email estimate form logic
    const emailForm = document.getElementById('estimateEmailForm');
    if (emailForm) {
      emailForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const name = document.getElementById('estimateName').value.trim();
        const email = document.getElementById('estimateEmail').value.trim();
        // Gather calculator selections
        const baseKey = form.elements['base_package'].value;
        let summary = `Estimate for ${name}\n\n`;
        summary += `Base Package: ${BASE_PACKAGES[baseKey].name} ($${BASE_PACKAGES[baseKey].price.toLocaleString()})\n`;
        // Add-ons
        const addonEls = form.querySelectorAll('input[name="addons"]:checked');
        if (addonEls.length) {
          summary += 'Add-ons:\n';
          addonEls.forEach(el => {
            summary += `- ${el.labels[0].innerText}\n`;
          });
        }
        // Discounts
        const discountEls = form.querySelectorAll('input[name="discounts"]:checked');
        if (discountEls.length) {
          summary += 'Discounts:\n';
          discountEls.forEach(el => {
            summary += `- ${el.labels[0].innerText}\n`;
          });
        }
        // Final price
        summary += `\n${result.textContent ? 'Estimated Total: ' + result.textContent : ''}`;
        // Send via EmailJS (or similar service)
        // Replace YOUR_SERVICE_ID, YOUR_TEMPLATE_ID, YOUR_USER_ID with your EmailJS credentials
        emailjs.send('YOUR_SERVICE_ID', 'YOUR_TEMPLATE_ID', {
          from_name: name,
          from_email: email,
          message: summary
        }, 'YOUR_USER_ID')
        .then(function() {
          document.getElementById('estimateEmailStatus').textContent = 'Estimate sent! Check your inbox.';
          emailForm.reset();
        }, function(error) {
          document.getElementById('estimateEmailStatus').textContent = 'Error sending estimate. Please try again.';
        });
      });
    }
  const form = document.getElementById('pricingCalculatorForm');
  const result = document.getElementById('pricingCalculatorResult');
  const breakdown = document.getElementById('pricingCalculatorBreakdown');

  if (!form) return;

  // Pricing data (should match PHP)
  const BASE_PACKAGES = {
    starter: { name: 'Starter Site', price: 2500 },
    growth: { name: 'Growth Site', price: 7500 },
    growth_advanced: { name: 'Growth Site - Advanced', price: 12000 },
    custom: { name: 'Custom/Enterprise', price: 18000 }
  };
  const ADD_ONS = {
    copywriting_basic: 500,
    copywriting_full: 1500,
    copywriting_advanced: 3000,
    content_migration: 800,
    ecommerce_basic: 2000,
    ecommerce_standard: 3500,
    payment_gateway: 500,
    booking_system: 1500,
    custom_forms: 800,
    blog_setup: 500,
    email_marketing: 600,
    video_integration: 400,
    // rush_2weeks and rush_1week handled separately
  };
  const PERCENT_ADD_ONS = {
    rush_2weeks: 25,
    rush_1week: 50
  };
  const DISCOUNTS = {
    nonprofit: 15,
    referral: 10,
    upfront_payment: 5
  };

  function formatMoney(val) {
    return '$' + val.toLocaleString(undefined, { minimumFractionDigits: 0 });
  }

  function calculate() {
    // Base package
    const baseKey = form.elements['base_package'].value;
    let basePrice = BASE_PACKAGES[baseKey].price;
    let breakdownHtml = `<div><strong>Base Package:</strong> ${BASE_PACKAGES[baseKey].name} (${formatMoney(basePrice)})</div>`;

    // Add-ons
    let addonsTotal = 0;
    let percentAdd = 0;
    let addonsHtml = '';
    const addonEls = form.querySelectorAll('input[name="addons"]:checked');
    addonEls.forEach(el => {
      const key = el.value;
      if (PERCENT_ADD_ONS[key]) {
        percentAdd += PERCENT_ADD_ONS[key];
        addonsHtml += `<div>+ ${el.labels[0].innerText}</div>`;
      } else if (ADD_ONS[key]) {
        addonsTotal += ADD_ONS[key];
        addonsHtml += `<div>+ ${el.labels[0].innerText}</div>`;
      }
    });

    let subtotal = basePrice + addonsTotal;
    if (addonsHtml) breakdownHtml += `<div class="mt-2"><strong>Add-ons:</strong>${addonsHtml}</div>`;

    // Rush/urgent add-ons (percentage based)
    let percentAddTotal = 0;
    if (percentAdd > 0) {
      percentAddTotal = subtotal * (percentAdd / 100);
      breakdownHtml += `<div>+ Rush/Urgent: ${percentAdd}% (${formatMoney(percentAddTotal)})</div>`;
    }
    subtotal += percentAddTotal;

    breakdownHtml += `<div class="mt-2"><strong>Subtotal:</strong> ${formatMoney(subtotal)}</div>`;

    // Discounts
    let discountTotal = 0;
    let discountsHtml = '';
    const discountEls = form.querySelectorAll('input[name="discounts"]:checked');
    discountEls.forEach(el => {
      const key = el.value;
      if (DISCOUNTS[key]) {
        const discount = subtotal * (DISCOUNTS[key] / 100);
        discountTotal += discount;
        discountsHtml += `<div>- ${el.labels[0].innerText} (${DISCOUNTS[key]}% = ${formatMoney(discount)})</div>`;
      }
    });
    if (discountsHtml) breakdownHtml += `<div class="mt-2"><strong>Discounts:</strong>${discountsHtml}</div>`;

    // Final total
    const finalTotal = Math.max(0, Math.round(subtotal - discountTotal));
    breakdownHtml += `<div class="mt-2"><strong>Final Total:</strong> ${formatMoney(finalTotal)}</div>`;

    // Payment schedule (standard 50/25/25)
    breakdownHtml += `<div class="mt-2"><strong>Payment Schedule:</strong><ul class="mb-0 ps-3">
      <li>Deposit (50%): ${formatMoney(finalTotal * 0.5)}</li>
      <li>Midpoint (25%): ${formatMoney(finalTotal * 0.25)}</li>
      <li>Final Payment (25%): ${formatMoney(finalTotal * 0.25)}</li>
    </ul></div>`;

    result.textContent = formatMoney(finalTotal);
    breakdown.innerHTML = breakdownHtml;
  }

  form.addEventListener('input', function(e) {
    if (e && e.target && e.target.name === 'base_package') {
      updateAddonAvailability();
    }
    calculate();
  });
  // Initialize add-on availability on load
  updateAddonAvailability();
  calculate();
});
