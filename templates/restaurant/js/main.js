// Restaurant Template - Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
  
  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (href === '#' || href === '#0') return;
      
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        const navHeight = document.querySelector('.navbar').offsetHeight + 56; // Include demo banner
        const targetPosition = target.offsetTop - navHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
        
        // Close mobile menu if open
        const navCollapse = document.querySelector('.navbar-collapse');
        if (navCollapse.classList.contains('show')) {
          bootstrap.Collapse.getInstance(navCollapse).hide();
        }
      }
    });
  });
  
  // Reservation Form Handling
  const reservationForm = document.querySelector('#reserve form');
  if (reservationForm) {
    reservationForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form data
      const formData = {
        name: document.getElementById('name').value,
        phone: document.getElementById('phone').value,
        date: document.getElementById('date').value,
        time: document.getElementById('time').value,
        guests: document.getElementById('guests').value,
        email: document.getElementById('email').value,
        notes: document.getElementById('notes').value
      };
      
      // Here you would typically send to your backend
      console.log('Reservation submitted:', formData);
      
      // Show success message
      const submitButton = this.querySelector('button[type="submit"]');
      const originalText = submitButton.innerHTML;
      submitButton.innerHTML = '<i class="bi bi-check-circle me-2"></i>Reservation Confirmed!';
      submitButton.classList.remove('btn-warning');
      submitButton.classList.add('btn-success');
      submitButton.disabled = true;
      
      setTimeout(() => {
        submitButton.innerHTML = originalText;
        submitButton.classList.remove('btn-success');
        submitButton.classList.add('btn-warning');
        submitButton.disabled = false;
        this.reset();
        
        // Show alert
        alert('Thank you! Your reservation request has been received. We\'ll confirm via phone shortly.');
      }, 2000);
    });
  }
  
  // Menu item "Add to Order" buttons
  const addToOrderButtons = document.querySelectorAll('.btn-warning[type="button"]');
  addToOrderButtons.forEach(button => {
    button.addEventListener('click', function() {
      const originalText = this.textContent;
      this.textContent = 'Added!';
      this.classList.add('btn-success');
      this.classList.remove('btn-warning');
      
      setTimeout(() => {
        this.textContent = originalText;
        this.classList.remove('btn-success');
        this.classList.add('btn-warning');
      }, 1500);
    });
  });
  
  // Set minimum date for reservation to today
  const dateInput = document.getElementById('date');
  if (dateInput) {
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);
  }
  
  // Navbar background on scroll
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        navbar.style.backgroundColor = 'rgba(0, 0, 0, 0.95)';
      } else {
        navbar.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
      }
    });
  }
  
  // Lazy loading fallback
  if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
      img.addEventListener('load', function() {
        this.classList.add('loaded');
      });
    });
  }
  
  // Phone number formatting
  const phoneInput = document.getElementById('phone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length > 0) {
        if (value.length <= 3) {
          value = `(${value}`;
        } else if (value.length <= 6) {
          value = `(${value.slice(0, 3)}) ${value.slice(3)}`;
        } else {
          value = `(${value.slice(0, 3)}) ${value.slice(3, 6)}-${value.slice(6, 10)}`;
        }
      }
      e.target.value = value;
    });
  }
  
  // Update active nav link on scroll
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.navbar-nav .nav-link[href^="#"]');
  
  function updateActiveNavLink() {
    const scrollPosition = window.scrollY + 200;
    
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute('id');
      
      if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === `#${sectionId}`) {
            link.classList.add('active');
          }
        });
      }
    });
  }
  
  window.addEventListener('scroll', updateActiveNavLink);
  
  // Gallery lightbox effect (simple implementation)
  const galleryImages = document.querySelectorAll('#gallery img');
  galleryImages.forEach(img => {
    img.style.cursor = 'pointer';
    img.addEventListener('click', function() {
      // In a real implementation, you'd open a lightbox modal here
      window.open(this.src, '_blank');
    });
  });
  
  // Order online button analytics tracking placeholder
  const orderButtons = document.querySelectorAll('a[href*="order"], a[href*="doordash"], a[href*="ubereats"]');
  orderButtons.forEach(button => {
    button.addEventListener('click', function() {
      const platform = this.textContent.trim();
      console.log(`Order clicked: ${platform}`);
      // Here you would track with Google Analytics, etc.
    });
  });
  
  // Back to top button
  const backToTopButton = document.createElement('button');
  backToTopButton.innerHTML = '<i class="bi bi-arrow-up"></i>';
  backToTopButton.className = 'btn btn-warning position-fixed bottom-0 end-0 m-4 rounded-circle';
  backToTopButton.style.cssText = 'width: 50px; height: 50px; opacity: 0; transition: opacity 0.3s; z-index: 1000; display: none;';
  backToTopButton.setAttribute('aria-label', 'Back to top');
  document.body.appendChild(backToTopButton);
  
  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 500) {
      backToTopButton.style.display = 'block';
      setTimeout(() => backToTopButton.style.opacity = '1', 10);
    } else {
      backToTopButton.style.opacity = '0';
      setTimeout(() => backToTopButton.style.display = 'none', 300);
    }
  });
  
  backToTopButton.addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
});
