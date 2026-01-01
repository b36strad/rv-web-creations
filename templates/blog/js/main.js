// Blog Template - Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
  
  // Reading Progress Bar (optional)
  function updateReadingProgress() {
    const article = document.querySelector('article');
    if (!article) return;
    
    const progressBar = document.createElement('div');
    progressBar.className = 'reading-progress';
    document.body.appendChild(progressBar);
    
    window.addEventListener('scroll', function() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrollPercent = (scrollTop / scrollHeight) * 100;
      progressBar.style.width = scrollPercent + '%';
    });
  }
  
  // Initialize reading progress (uncomment to enable)
  // updateReadingProgress();
  
  // Copy Link to Clipboard
  const copyLinkButtons = document.querySelectorAll('.btn:has(.bi-link-45deg)');
  copyLinkButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      navigator.clipboard.writeText(window.location.href).then(() => {
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="bi bi-check2"></i> Copied!';
        setTimeout(() => {
          this.innerHTML = originalText;
        }, 2000);
      });
    });
  });
  
  // Newsletter Form Submission (basic example - replace with your service)
  const newsletterForms = document.querySelectorAll('form:has(input[type="email"])');
  newsletterForms.forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;
      
      // Replace with your newsletter service API call
      console.log('Newsletter signup:', email);
      
      // Show success message
      const button = this.querySelector('button[type="submit"]');
      const originalText = button.textContent;
      button.textContent = 'Subscribed!';
      button.classList.remove('btn-primary', 'btn-light');
      button.classList.add('btn-success');
      
      setTimeout(() => {
        button.textContent = originalText;
        button.classList.remove('btn-success');
        button.classList.add('btn-primary');
        form.reset();
      }, 3000);
    });
  });
  
  // Smooth scroll to anchors
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (href === '#') return;
      
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
  
  // Category filter functionality (if blog.html page exists)
  const categoryButtons = document.querySelectorAll('.btn-outline-secondary');
  if (categoryButtons.length > 0) {
    categoryButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Remove active state from all buttons
        categoryButtons.forEach(btn => {
          btn.classList.remove('btn-primary');
          btn.classList.add('btn-outline-secondary');
        });
        
        // Add active state to clicked button
        this.classList.remove('btn-outline-secondary');
        this.classList.add('btn-primary');
        
        // Filter logic would go here
        const category = this.textContent.trim();
        console.log('Filter by category:', category);
      });
    });
  }
  
  // Image lazy loading fallback for older browsers
  if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
      img.src = img.dataset.src || img.src;
    });
  } else {
    // Fallback for browsers that don't support lazy loading
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
    document.body.appendChild(script);
  }
  
  // Social share functionality
  const shareButtons = document.querySelectorAll('.btn:has(.bi-twitter), .btn:has(.bi-linkedin)');
  shareButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const url = encodeURIComponent(window.location.href);
      const title = encodeURIComponent(document.title);
      
      let shareUrl = '';
      if (this.querySelector('.bi-twitter')) {
        shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
      } else if (this.querySelector('.bi-linkedin')) {
        shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
      }
      
      if (shareUrl) {
        window.open(shareUrl, 'share', 'width=550,height=450');
      }
    });
  });
  
  // Add "Back to Top" button functionality
  const backToTopButton = document.createElement('button');
  backToTopButton.innerHTML = '<i class="bi bi-arrow-up"></i>';
  backToTopButton.className = 'btn btn-primary position-fixed bottom-0 end-0 m-4 rounded-circle';
  backToTopButton.style.cssText = 'width: 50px; height: 50px; opacity: 0; transition: opacity 0.3s; z-index: 1000; display: none;';
  backToTopButton.setAttribute('aria-label', 'Back to top');
  document.body.appendChild(backToTopButton);
  
  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
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
