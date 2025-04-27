document.addEventListener('DOMContentLoaded', function() {
    console.log('Masonry Website Loaded 🚀');
  
    // Auto-initialize carousel (optional, since data-bs-ride="carousel" already set)
    const heroCarousel = document.querySelector('#hero-carousel');
    if (heroCarousel) {
      new bootstrap.Carousel(heroCarousel, {
        interval: 5000,    // Auto-slide every 5 seconds
        ride: 'carousel',
        pause: 'hover',
        wrap: true
      });
    }
  
    // Close navbar menu on mobile after click
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    navLinks.forEach(function(link) {
      link.addEventListener('click', function() {
        if (navbarCollapse.classList.contains('show')) {
          new bootstrap.Collapse(navbarCollapse).toggle();
        }
      });
    });
  });
  