const $ = (selector, root = document) => root.querySelector(selector);
const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

function initAddonDropdowns() {
  document.querySelectorAll('.addon-card').forEach((card) => {
    const dropdown = card.querySelector('.addon-dropdown');
    const options = card.querySelector('.addon-options');
    const title = card.querySelector('.addon-title');
    if (!dropdown || !options || !title) return;

    const optionElements = options.querySelectorAll('.addon-option');
    const defaultTitle = dropdown.getAttribute('data-default') || title.textContent;

    function closeDropdowns() {
      document.querySelectorAll('.addon-dropdown.open').forEach((openDropdown) => {
        openDropdown.classList.remove('open');
      });
      document.querySelectorAll('.addon-options').forEach((optionList) => {
        optionList.style.display = '';
      });
    }

    dropdown.addEventListener('click', (event) => {
      event.stopPropagation();
      const isOpen = dropdown.classList.contains('open');
      closeDropdowns();
      if (!isOpen) {
        dropdown.classList.add('open');
        options.style.display = 'block';
      }
    });

    optionElements.forEach((option) => {
      option.addEventListener('click', (event) => {
        event.stopPropagation();
        optionElements.forEach((item) => item.classList.remove('selected'));
        option.classList.add('selected');
        title.textContent = option.textContent;
        closeDropdowns();
      });
    });

    dropdown.addEventListener('blur', () => {
      window.setTimeout(closeDropdowns, 120);
    });

    title.textContent = defaultTitle;
  });

  document.addEventListener('click', () => {
    document.querySelectorAll('.addon-dropdown.open').forEach((dropdown) => {
      dropdown.classList.remove('open');
    });
    document.querySelectorAll('.addon-options').forEach((options) => {
      options.style.display = '';
    });
  });
}

async function injectPartial(slotId, url) {
  const slot = document.getElementById(slotId);
  if (!slot) return;

  try {
    const response = await fetch(url, { cache: 'no-store' });
    if (!response.ok) throw new Error(`Failed to load ${url}: ${response.status}`);
    slot.innerHTML = await response.text();
  } catch (error) {
    slot.innerHTML = '<div class="container" style="padding:14px 0">Shared layout failed to load. Run this site through a local server.</div>';
    console.error(error);
  }
}

function setActiveNav() {
  const currentPath = (location.pathname.split('/').pop() || 'index.html').toLowerCase();
  $$('[data-nav]').forEach((link) => {
    const href = (link.getAttribute('href') || '').toLowerCase();
    const isActive = href === currentPath || (currentPath === '' && href === 'index.html');
    link.classList.toggle('is-active', isActive);
    if (isActive) link.setAttribute('aria-current', 'page');
    else link.removeAttribute('aria-current');
  });
}

function initHeaderBehavior() {
  const header = document.querySelector('[data-elevate]');
  const menu = $('#nav-menu');
  const toggle = $('.nav-toggle');

  if (header) {
    const updateElevation = () => header.classList.toggle('is-elevated', window.scrollY > 8);
    window.addEventListener('scroll', updateElevation, { passive: true });
    updateElevation();
  }

  if (!toggle || !menu) return;

  toggle.addEventListener('click', () => {
    const isOpen = menu.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(isOpen));
    toggle.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
  });

  menu.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      menu.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Open menu');
    });
  });

  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    menu.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Open menu');
  });
}

function initFooterYear() {
  const yearElement = $('#year');
  if (yearElement) yearElement.textContent = String(new Date().getFullYear());
}

function initContactForm() {
  const form = $('#estimateForm');
  const submitButton = $('#submitBtn');
  const notice = $('#formNotice');
  if (!form) return;

  function setNotice(message, isError = false) {
    if (!notice) return;
    notice.textContent = message;
    notice.classList.toggle('danger', isError);
  }

  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (!form.checkValidity()) {
      setNotice('Please complete the required fields.', true);
      form.querySelector(':invalid')?.focus();
      return;
    }

    if (submitButton) submitButton.disabled = true;
    setNotice('Sending your request…');

    try {
      const response = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
      });
      const data = await response.json();
      if (!response.ok || !data.success) {
        throw new Error(data.message || 'Failed to send. Please try again.');
      }

      form.reset();
      setNotice('Inquiry sent. You’ll hear back within 1–2 business days.');
    } catch (error) {
      setNotice(error.message || 'Error sending form. Please try again.', true);
    } finally {
      if (submitButton) submitButton.disabled = false;
    }
  });
}

async function boot() {
  await injectPartial('site-header-slot', 'header.html');
  setActiveNav();
  initHeaderBehavior();
  await injectPartial('site-footer-slot', 'footer.html');
  initFooterYear();
  initAddonDropdowns();
  initContactForm();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', boot);
} else {
  boot();
}

