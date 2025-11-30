// Growth Template JavaScript

(function() {
  'use strict';

  // Initialize when DOM is ready
  document.addEventListener('DOMContentLoaded', function() {
    initializeComponents();
    initializeScrollEffects();
    initializeStats();
    initializePortfolio();
  });

  // Initialize all components
  function initializeComponents() {
    // Navbar scroll effect
    handleNavbarScroll();
    
    // Smooth scroll for anchor links
    initializeSmoothScroll();
    
    // Initialize tooltips
    initializeTooltips();
    
    // Initialize popovers
    initializePopovers();
  }

  // Navbar scroll effect
  function handleNavbarScroll() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    window.addEventListener('scroll', function() {
      if (window.scrollY > 100) {
        navbar.classList.add('shadow-sm');
        navbar.style.paddingTop = '0.5rem';
        navbar.style.paddingBottom = '0.5rem';
      } else {
        navbar.classList.remove('shadow-sm');
        navbar.style.paddingTop = '1rem';
        navbar.style.paddingBottom = '1rem';
      }
    });
  }

  // Smooth scroll for anchor links
  function initializeSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        
        e.preventDefault();
        const target = document.querySelector(href);
        
        if (target) {
          const offsetTop = target.offsetTop - 80;
          window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  // Initialize tooltips
  function initializeTooltips() {
    const tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  }

  // Initialize popovers
  function initializePopovers() {
    const popoverTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
  }

  // Scroll effects for elements
  function initializeScrollEffects() {
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fade-in');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observe all cards, images, and sections
    document.querySelectorAll('.card, section img, .stat-card').forEach(el => {
      observer.observe(el);
    });
  }

  // Animated statistics counter
  function initializeStats() {
    const stats = document.querySelectorAll('.stat-number, .display-4');
    
    const observerOptions = {
      threshold: 0.5
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateValue(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    stats.forEach(stat => {
      // Check if the element contains a number
      const text = stat.textContent.trim();
      if (/\d+/.test(text)) {
        observer.observe(stat);
      }
    });
  }

  // Animate number counting
  function animateValue(element) {
    const text = element.textContent;
    const hasPlus = text.includes('+');
    const hasPercent = text.includes('%');
    const number = parseInt(text.replace(/\D/g, ''));
    
    if (isNaN(number)) return;

    const duration = 2000;
    const steps = 60;
    const increment = number / steps;
    let current = 0;

    const timer = setInterval(() => {
      current += increment;
      if (current >= number) {
        current = number;
        clearInterval(timer);
      }
      
      let displayValue = Math.floor(current);
      if (hasPlus) displayValue += '+';
      if (hasPercent) displayValue += '%';
      
      element.textContent = displayValue;
    }, duration / steps);
  }

  // Portfolio filtering and lightbox
  function initializePortfolio() {
    // Filter buttons
    const filterButtons = document.querySelectorAll('[data-filter]');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        
        // Update active button
        filterButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        // Filter items
        portfolioItems.forEach(item => {
          if (filter === 'all' || item.getAttribute('data-category') === filter) {
            item.style.display = 'block';
            setTimeout(() => {
              item.classList.add('animate-fade-in');
            }, 10);
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // Form validation enhancement
  window.validateForm = function(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;

    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
      if (!input.value.trim()) {
        isValid = false;
        input.classList.add('is-invalid');
      } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
      }
    });

    // Email validation
    const emailInputs = form.querySelectorAll('input[type="email"]');
    emailInputs.forEach(input => {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (input.value && !emailRegex.test(input.value)) {
        isValid = false;
        input.classList.add('is-invalid');
      }
    });

    return isValid;
  };

  // Quote form calculator
  window.calculateQuote = function() {
    const form = document.getElementById('quoteForm');
    if (!form) return;

    const projectType = form.querySelector('[name="projectType"]')?.value;
    const timeline = form.querySelector('[name="timeline"]')?.value;
    const budget = form.querySelector('[name="budget"]')?.value;

    // Simple calculation logic (customize as needed)
    let estimatedCost = 0;
    
    if (projectType === 'website') estimatedCost = 5000;
    else if (projectType === 'webapp') estimatedCost = 15000;
    else if (projectType === 'branding') estimatedCost = 3000;
    else if (projectType === 'marketing') estimatedCost = 4000;

    if (timeline === 'urgent') estimatedCost *= 1.3;
    else if (timeline === 'flexible') estimatedCost *= 0.9;

    const resultDiv = document.getElementById('quoteResult');
    if (resultDiv) {
      resultDiv.innerHTML = `
        <div class="alert alert-success">
          <h5>Estimated Investment</h5>
          <p class="display-6 mb-0">$${estimatedCost.toLocaleString()}</p>
          <small>This is a preliminary estimate. Final pricing will be provided after consultation.</small>
        </div>
      `;
      resultDiv.scrollIntoView({ behavior: 'smooth' });
    }
  };

  // Blog search functionality
  window.searchBlog = function(query) {
    const posts = document.querySelectorAll('.blog-post');
    const searchTerm = query.toLowerCase();

    posts.forEach(post => {
      const title = post.querySelector('h5')?.textContent.toLowerCase() || '';
      const excerpt = post.querySelector('p')?.textContent.toLowerCase() || '';
      
      if (title.includes(searchTerm) || excerpt.includes(searchTerm)) {
        post.style.display = 'block';
      } else {
        post.style.display = 'none';
      }
    });
  };

  // FAQ accordion auto-collapse
  const faqAccordion = document.querySelector('.accordion');
  if (faqAccordion) {
    faqAccordion.addEventListener('shown.bs.collapse', function(e) {
      const accordionBody = e.target;
      const offsetTop = accordionBody.previousElementSibling.offsetTop - 100;
      window.scrollTo({
        top: offsetTop,
        behavior: 'smooth'
      });
    });
  }

  // Back to top button
  const backToTopButton = document.createElement('button');
  backToTopButton.innerHTML = '<i class="bi bi-arrow-up"></i>';
  backToTopButton.className = 'btn btn-primary rounded-circle position-fixed';
  backToTopButton.style.cssText = 'bottom: 20px; right: 20px; width: 50px; height: 50px; display: none; z-index: 1000;';
  document.body.appendChild(backToTopButton);

  window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
      backToTopButton.style.display = 'block';
    } else {
      backToTopButton.style.display = 'none';
    }
  });

  backToTopButton.addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  // Newsletter form
  window.subscribeNewsletter = function(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;

    const email = form.querySelector('input[type="email"]')?.value;
    
    if (!email || !email.includes('@')) {
      alert('Please enter a valid email address');
      return false;
    }

    // Here you would normally send to your email service
    alert('Thank you for subscribing!');
    form.reset();
    return false;
  };

})();
