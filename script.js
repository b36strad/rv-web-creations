// Add-on dropdown logic (title as toggle)
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.addon-card').forEach(function(card) {
    var dropdown = card.querySelector('.addon-dropdown');
    var options = card.querySelector('.addon-options');
    var title = dropdown.querySelector('.addon-title');
    var optionEls = options.querySelectorAll('.addon-option');
    var defaultTitle = dropdown.getAttribute('data-default') || title.textContent;

    function closeAll() {
      document.querySelectorAll('.addon-dropdown.open').forEach(function(opened) {
        if (opened !== dropdown) opened.classList.remove('open');
      });
      document.querySelectorAll('.addon-options').forEach(function(optList) {
        if (optList !== options) optList.style.display = '';
      });
    }

    dropdown.addEventListener('click', function(e) {
      e.stopPropagation();
      var isOpen = dropdown.classList.toggle('open');
      closeAll();
      if (isOpen) {
        options.style.display = 'block';
      } else {
        options.style.display = '';
      }
    });

    optionEls.forEach(function(opt) {
      opt.addEventListener('click', function(e) {
        e.stopPropagation();
        optionEls.forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
        title.textContent = opt.textContent;
        dropdown.classList.remove('open');
        options.style.display = '';
      });
    });

    // Close dropdown on blur
    dropdown.addEventListener('blur', function() {
      setTimeout(function() {
        dropdown.classList.remove('open');
        options.style.display = '';
      }, 120);
    });

    // Set default title
    title.textContent = defaultTitle;
  });

  document.addEventListener('click', function() {
    document.querySelectorAll('.addon-dropdown.open').forEach(function(opened) {
      opened.classList.remove('open');
    });
    document.querySelectorAll('.addon-options').forEach(function(optList) {
      optList.style.display = '';
    });
  });
});
/* =========================
   Multi-page Authority Template JS
   - injects shared header/footer (header.html/footer.html)
   - highlights active nav link
   - mobile nav toggle
   - sticky header elevation
   - optional pricing->contact budget prefill via querystring (?budget=6500)
   - contact page: checklist gating + budget filtering + basic validation UX
========================= */

(function () {
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  async function injectPartial(slotId, url) {
    const slot = document.getElementById(slotId);
    if (!slot) return;

    try {
      const res = await fetch(url, { cache: "no-store" });
      if (!res.ok) throw new Error(`Failed to load ${url}: ${res.status}`);
      slot.innerHTML = await res.text();
    } catch (err) {
      slot.innerHTML = `<div class="container" style="padding:14px 0; color: rgba(234,240,255,.78)">
        Shared layout failed to load. If you opened this file directly, run a local server.
      </div>`;
      console.error(err);
    }
  }

  function setActiveNav() {
    const path = (location.pathname.split("/").pop() || "index.html").toLowerCase();

    $$("[data-nav]").forEach((a) => {
      const href = (a.getAttribute("href") || "").toLowerCase();
      const isActive = href === path || (path === "" && href === "index.html");
      a.classList.toggle("is-active", isActive);
      if (isActive) a.setAttribute("aria-current", "page");
      else a.removeAttribute("aria-current");
    });
  }

  function initHeaderBehavior() {
    const header = document.querySelector("[data-elevate]");
    const menu = $("#nav-menu");
    const toggle = $(".nav-toggle");

    const onScroll = () => {
      if (!header) return;
      header.classList.toggle("is-elevated", window.scrollY > 8);
    };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();

    if (toggle && menu) {
      toggle.addEventListener("click", () => {
        const open = menu.classList.toggle("is-open");
        toggle.setAttribute("aria-expanded", open ? "true" : "false");
        toggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
      });

      $$("#nav-menu a").forEach((a) => {
        a.addEventListener("click", () => {
          menu.classList.remove("is-open");
          toggle.setAttribute("aria-expanded", "false");
          toggle.setAttribute("aria-label", "Open menu");
        });
      });

      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
          menu.classList.remove("is-open");
          toggle.setAttribute("aria-expanded", "false");
          toggle.setAttribute("aria-label", "Open menu");
        }
      });
    }
  }

  function initFooterYear() {
    const yearEl = $("#year");
    if (yearEl) yearEl.textContent = String(new Date().getFullYear());
  }

  function initBudgetPrefill() {
    const params = new URLSearchParams(location.search);
    const prefill = params.get("budget");
    const budgetSelect = $("#budget");
    if (budgetSelect && prefill) {
      budgetSelect.value = prefill;
      budgetSelect.dispatchEvent(new Event("change", { bubbles: true }));
    }
  }

  function initContactGatingIfPresent() {
    const checklistForm = $("#fitChecklist");
    const checklistNotice = $("#checklistNotice");
    const estimateForm = $("#estimateForm");
    const budgetSelect = $("#budget");
    const submitBtn = $("#submitBtn");
    const formNotice = $("#formNotice");

    if (!checklistForm || !estimateForm) return;

    function setNotice(msg, type) {
      if (!formNotice) return;
      formNotice.textContent = msg || "";
      formNotice.classList.toggle("danger", type === "danger");
    }

    // Helper to enable/disable all fields in the estimate form
    function setEstimateFormEnabled(enabled) {
      if (!estimateForm) return;
      const elements = estimateForm.querySelectorAll('input, textarea, select, button');
      elements.forEach(el => {
        if (el.id === 'submitBtn') {
          el.disabled = !enabled;
        } else {
          el.disabled = !enabled;
        }
      });
    }

    function disableSubmit(reason) {
      if (submitBtn) submitBtn.disabled = true;
      if (reason) setNotice(reason, "danger");
    }

    function enableSubmit(msg) {
      if (submitBtn) submitBtn.disabled = false;
      setNotice(msg || "", "ok");
    }

    function checklistComplete() {
      const required = $$('input[type="checkbox"][required]', checklistForm);
      return required.length > 0 && required.every((i) => i.checked);
    }

    function updateGating() {
      const ok = checklistComplete();
      if (checklistNotice) {
        checklistNotice.textContent = ok
          ? "Checklist complete. You can submit the request."
          : "Check all boxes to unlock the Contact & Project Details form.";
        checklistNotice.classList.toggle("danger", !ok);
      }

      setEstimateFormEnabled(ok);
      if (!ok) {
        disableSubmit("Complete the checklist above to continue.");
        return;
      }
      budgetSelect?.dispatchEvent(new Event("change", { bubbles: true }));
    }

    checklistForm.addEventListener("change", updateGating);
    // On load, lock the estimate form if checklist is not complete
    updateGating();

    if (budgetSelect) {
      budgetSelect.addEventListener("change", () => {
        const okChecklist = checklistComplete();
        if (!okChecklist) {
          disableSubmit("Complete the checklist to continue.");
          return;
        }

        const v = budgetSelect.value;

        if (v === "under") {
          disableSubmit(
            "This service is intentionally not designed for budgets under $5,000. If you want, request alternatives (DIY/template) instead."
          );
          return;
        }

        if (v === "unsure" || v === "") {
          disableSubmit("Select a budget range to continue.");
          return;
        }

        enableSubmit("");
      });
    }

    estimateForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      if (!checklistComplete()) {
        disableSubmit("Complete the checklist to continue.");
        return;
      }

      if (!estimateForm.checkValidity()) {
        setNotice("Please complete the required fields.", "danger");
        estimateForm.querySelector(":invalid")?.focus();
        return;
      }

      if (budgetSelect?.value === "under") {
        disableSubmit("This service is not designed for budgets under $5,000.");
        return;
      }

      disableSubmit("Sending...");
      const formData = new FormData(estimateForm);
      try {
        const response = await fetch(estimateForm.action, {
          method: "POST",
          body: formData,
        });
        const data = await response.json();
        if (data.success) {
          enableSubmit("Inquiry sent! If it’s a fit, you’ll hear back in 1–2 business days.");
          estimateForm.reset();
          if (budgetSelect) budgetSelect.value = "";
          disableSubmit("Select a budget range to continue.");
        } else {
          setNotice(data.message || "Failed to send. Please try again.", "danger");
        }
      } catch (err) {
        setNotice("Error sending form. Please try again.", "danger");
      }
    });
  }

  async function boot() {
    await injectPartial("site-header-slot", "header.html");
    setActiveNav();
    initHeaderBehavior();

    await injectPartial("site-footer-slot", "footer.html");
    initFooterYear();

    initBudgetPrefill();
    initContactGatingIfPresent();
  }

  boot();
})();

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("estimateForm");
  const submitBtn = document.getElementById("submitBtn");
  const notice = document.getElementById("formNotice");

  if (!form) return;

  let hasSubmitted = false;

  function getRequiredFields() {
    return form.querySelectorAll("[required]");
  }

  function isFieldValid(field) {
    if (field.type === "hidden") return field.value.trim() !== "";
    if (field.type === "email") return field.checkValidity();
    return field.value.trim() !== "";
  }

  function clearDropdownErrorState(hiddenField) {
    const addonCard = hiddenField.closest(".addon-card");
    if (!addonCard) return;
    const dropdownUI = addonCard.querySelector(".addon-dropdown");
    addonCard.classList.remove("field-error");
    dropdownUI?.classList.remove("field-error");
  }

  function setDropdownErrorState(hiddenField, isInvalid) {
    const addonCard = hiddenField.closest(".addon-card");
    if (!addonCard) return;
    const dropdownUI = addonCard.querySelector(".addon-dropdown");

    // Put the error class on the visible UI (preferred) and/or the card wrapper.
    addonCard.classList.toggle("field-error", isInvalid);
    dropdownUI?.classList.toggle("field-error", isInvalid);
  }

  function validateForm(showErrors = false) {
    let allValid = true;

    getRequiredFields().forEach(field => {
      const valid = isFieldValid(field);

      // Only apply visual error states after submit attempt
      if (showErrors) {
        if (field.type === "hidden") {
          // Hidden fields = dropdown selections (goal/budget) in your markup :contentReference[oaicite:1]{index=1}
          setDropdownErrorState(field, !valid);
        } else {
          field.classList.toggle("field-error", !valid);
        }
      } else {
        // Before submit: keep UI clean (no red outlines anywhere)
        if (field.type === "hidden") clearDropdownErrorState(field);
        else field.classList.remove("field-error");
      }

      if (!valid) allValid = false;
    });

    submitBtn.disabled = !allValid;

    if (!allValid && showErrors) {
      notice.textContent = "Please complete all required fields before submitting.";
      notice.classList.add("error");
    } else {
      notice.textContent = "";
      notice.classList.remove("error");
    }

    return allValid;
  }

  // Live validation only AFTER the first submit attempt
  form.addEventListener("input", () => validateForm(hasSubmitted));
  form.addEventListener("change", () => validateForm(hasSubmitted));

  form.addEventListener("submit", (e) => {
    hasSubmitted = true;
    if (!validateForm(true)) {
      e.preventDefault();
      e.stopPropagation();
    }
  });

  // Initial state: no errors shown
  validateForm(false);
});

