/* ========================================
   STICKY NAVBAR SCROLL DETECTION
   Para mag-add ng "scrolled" class kapag nag-scroll
   ======================================== */

document.addEventListener('DOMContentLoaded', function() {
    // Get navbar element
    const navbar = document.querySelector('.navbar');

    // Scroll event listener
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            // Kapag nag-scroll na 100px, mag-add ng "scrolled" class
            navbar.classList.add('scrolled');
        } else {
            // Kapag bumalik sa top, tanggalin ang "scrolled" class
            navbar.classList.remove('scrolled');
        }
    });

    // Smooth scrolling for anchor links (bonus feature)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
