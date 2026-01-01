/**
 * Starter Template Main JavaScript
 * =================================
 * Template-specific functionality
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  
  // Initialize all functionality
  initContactForm();
  initScrollAnimations();
  
  // Log template info in development
  if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    console.log('Starter Template - Active');
  }
});

/**
 * Contact Form Handler
 */
function initContactForm() {
  const contactForm = document.querySelector('form[action="contact-handler.php"]');
  
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      if (!contactForm.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        contactForm.classList.add('was-validated');
        return;
      }
      
      // Optional: Add loading state to submit button
      const submitBtn = contactForm.querySelector('button[type="submit"]');
      if (submitBtn && window.rvUtils) {
        // The form will submit normally, but show loading state
        window.rvUtils.setLoading(submitBtn, true);
      }
    });
    
    // Clear validation on input change
    const inputs = contactForm.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      input.addEventListener('input', function() {
        if (contactForm.classList.contains('was-validated')) {
          if (this.checkValidity()) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
          } else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
          }
        }
      });
    });
  }
}

/**
 * Enhanced Scroll Animations
 */
function initScrollAnimations() {
  // Add staggered animation delays to elements with data-animate
  const animatedElements = document.querySelectorAll('[data-animate]');
  
  animatedElements.forEach((element, index) => {
    // Add a slight delay based on element position
    element.style.animationDelay = `${index * 0.1}s`;
  });
  
  // Animate numbers (for stats section)
  const statsNumbers = document.querySelectorAll('.display-4');
  
  const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
  };
  
  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && entry.target.textContent.match(/^\[\d+\+?\]$/)) {
        animateNumber(entry.target);
        statsObserver.unobserve(entry.target);
      }
    });
  }, observerOptions);
  
  statsNumbers.forEach(stat => {
    if (stat.textContent.match(/^\[\d+\+?\]$/)) {
      statsObserver.observe(stat);
    }
  });
}

/**
 * Animate number counting effect
 */
function animateNumber(element) {
  const text = element.textContent;
  const match = text.match(/\[(\d+)(\+?)\]/);
  
  if (!match) return;
  
  const targetNumber = parseInt(match[1]);
  const hasPlus = match[2] === '+';
  const duration = 2000; // 2 seconds
  const steps = 60;
  const increment = targetNumber / steps;
  const stepDuration = duration / steps;
  
  let currentNumber = 0;
  
  const counter = setInterval(() => {
    currentNumber += increment;
    
    if (currentNumber >= targetNumber) {
      currentNumber = targetNumber;
      clearInterval(counter);
    }
    
    element.textContent = Math.floor(currentNumber) + (hasPlus ? '+' : '');
  }, stepDuration);
}

/**
 * Handle URL parameters (e.g., for success messages)
 */
const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('success')) {
  const successParam = urlParams.get('success');
  
  if (successParam === 'contact' && window.rvUtils) {
    window.rvUtils.showToast('Thank you! Your message has been sent successfully.', 'success');
    
    // Clean URL
    window.history.replaceState({}, document.title, window.location.pathname);
  }
}

if (urlParams.has('error')) {
  const errorParam = urlParams.get('error');
  
  if (errorParam === 'contact' && window.rvUtils) {
    window.rvUtils.showToast('Sorry, there was an error sending your message. Please try again.', 'danger');
    
    // Clean URL
    window.history.replaceState({}, document.title, window.location.pathname);
  }
}

/**
 * Handle external links
 */
const externalLinks = document.querySelectorAll('a[href^="http"]');
externalLinks.forEach(link => {
  const currentDomain = window.location.hostname;
  const linkDomain = new URL(link.href).hostname;
  
  if (currentDomain !== linkDomain) {
    link.setAttribute('target', '_blank');
    link.setAttribute('rel', 'noopener noreferrer');
  }
});

/**
 * Image lazy loading fallback
 */
if (!('loading' in HTMLImageElement.prototype)) {
  const images = document.querySelectorAll('img[loading="lazy"]');
  
  const imageObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src || img.src;
        imageObserver.unobserve(img);
      }
    });
  });
  
  images.forEach(img => imageObserver.observe(img));
}

/**
 * Navbar mobile menu auto-close
 */
const navbarToggler = document.querySelector('.navbar-toggler');
const navbarCollapse = document.querySelector('.navbar-collapse');
const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

if (navbarToggler && navbarCollapse) {
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth < 992) { // Bootstrap lg breakpoint
        const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
        if (bsCollapse) {
          bsCollapse.hide();
        }
      }
    });
  });
}

/**
 * Copy email/phone on click (optional enhancement)
 */
const contactLinks = document.querySelectorAll('a[href^="mailto:"], a[href^="tel:"]');

contactLinks.forEach(link => {
  link.addEventListener('click', function(e) {
    // Optional: copy to clipboard on click
    const text = this.textContent.trim();
    
    if (window.rvUtils && text) {
      // Don't prevent default - let the mailto/tel still work
      setTimeout(() => {
        window.rvUtils.copyToClipboard(text);
      }, 100);
    }
  });
});

/**
 * Testimonial rotation (if you want auto-rotating testimonials)
 */
function initTestimonialRotation() {
  const testimonials = document.querySelectorAll('.testimonial-card');
  
  if (testimonials.length > 0) {
    let currentIndex = 0;
    
    setInterval(() => {
      testimonials[currentIndex].classList.remove('active');
      currentIndex = (currentIndex + 1) % testimonials.length;
      testimonials[currentIndex].classList.add('active');
    }, 5000); // Rotate every 5 seconds
  }
}

// Uncomment to enable:
// initTestimonialRotation();

/**
 * Service filtering (if you add filtering to services page)
 */
function initServiceFiltering() {
  const filterButtons = document.querySelectorAll('[data-filter]');
  const serviceCards = document.querySelectorAll('[data-category]');
  
  if (filterButtons.length > 0 && serviceCards.length > 0) {
    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        const filter = this.dataset.filter;
        
        // Update active button
        filterButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        
        // Filter cards
        serviceCards.forEach(card => {
          if (filter === 'all' || card.dataset.category === filter) {
            card.style.display = 'block';
            card.classList.add('animate-fade-in-up');
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }
}

// Export for use in other scripts if needed
window.starterTemplate = {
  animateNumber,
  initContactForm,
  initScrollAnimations
};
