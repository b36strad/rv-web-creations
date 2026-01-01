/*
 * Professional Services Template JavaScript
 */

// Add scrolled class to navbar
window.addEventListener('scroll', function() {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

// Initialize tooltips if Bootstrap is available
document.addEventListener('DOMContentLoaded', function() {
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  if (typeof bootstrap !== 'undefined') {
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  }
  // Collapse navbar after clicking a nav-link (for mobile usability)
  var navbarCollapse = document.getElementById('navbarNav');
  if (navbarCollapse) {
    navbarCollapse.querySelectorAll('.nav-link').forEach(function(link) {
      link.addEventListener('click', function(e) {
        var href = link.getAttribute('href');
        if (href && href.startsWith('#')) {
          var target = document.querySelector(href);
          if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            // Collapse after scroll finishes (estimate 500ms)
            if (window.innerWidth < 992) {
              setTimeout(function() {
                var bsCollapse = bootstrap.Collapse.getOrCreateInstance(navbarCollapse);
                bsCollapse.hide();
              }, 500);
            }
            return;
          }
        }
        // For non-anchor links, collapse immediately
        if (window.innerWidth < 992) {
          var bsCollapse = bootstrap.Collapse.getOrCreateInstance(navbarCollapse);
          bsCollapse.hide();
        }
      });
    });
  }
});
