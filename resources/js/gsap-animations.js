// GSAP Animation System for LFHS
// =================================
// Enhanced animations using GSAP for text, logos, and images

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { TextPlugin } from 'gsap/TextPlugin';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger, TextPlugin);

// Initialize all animations when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('GSAP Animations Initialized');

    // Initialize all animation modules
    initHeroAnimations();
    initLogoAnimations();
    initImageAnimations();
    initTextAnimations();
    initScrollAnimations();
    initCardAnimations();
    initButtonAnimations();
    initNavbarAnimations();
});

// ============================================
// HERO SECTION ANIMATIONS
// ============================================
function initHeroAnimations() {
    const heroHeadings = document.querySelectorAll('.carousel-slide h1, .carousel-slide h2, .hero-title');
    const heroSubtext = document.querySelectorAll('.carousel-slide p');
    const heroButtons = document.querySelectorAll('.carousel-slide a');
    const heroImages = document.querySelectorAll('.carousel-slide img');

    // Professional fade-in animation for headings (simpler and cleaner)
    heroHeadings.forEach(heading => {
        // Skip if heading is already being animated by carousel
        if (heading.closest('.carousel-slide')) {
            // Only animate when slide becomes active
            const observer = new MutationObserver(() => {
                const slide = heading.closest('.carousel-slide');
                if (slide && slide.style.opacity === '1') {
                    gsap.from(heading, {
                        duration: 1,
                        opacity: 0,
                        y: 40,
                        ease: 'power3.out',
                        clearProps: 'all'
                    });
                    observer.disconnect();
                }
            });

            const slide = heading.closest('.carousel-slide');
            if (slide) {
                observer.observe(slide, { attributes: true, attributeFilter: ['style'] });
            }
        } else {
            // Regular headings outside carousel
            gsap.from(heading, {
                duration: 1,
                opacity: 0,
                y: 40,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: heading,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                }
            });
        }
    });

    // Animate hero subtitle with fade and slide
    heroSubtext.forEach(text => {
        const observer = new MutationObserver(() => {
            const slide = text.closest('.carousel-slide');
            if (slide && slide.style.opacity === '1') {
                gsap.from(text, {
                    duration: 1,
                    opacity: 0,
                    y: 30,
                    ease: 'power3.out',
                    delay: 0.2,
                    clearProps: 'all'
                });
                observer.disconnect();
            }
        });

        const slide = text.closest('.carousel-slide');
        if (slide) {
            observer.observe(slide, { attributes: true, attributeFilter: ['style'] });
        }
    });

    // Animate hero buttons with professional fade and lift
    heroButtons.forEach((button, index) => {
        const observer = new MutationObserver(() => {
            const slide = button.closest('.carousel-slide');
            if (slide && slide.style.opacity === '1') {
                gsap.from(button, {
                    duration: 0.8,
                    opacity: 0,
                    y: 20,
                    ease: 'power3.out',
                    delay: 0.4 + (index * 0.1),
                    clearProps: 'all'
                });
                observer.disconnect();
            }
        });

        const slide = button.closest('.carousel-slide');
        if (slide) {
            observer.observe(slide, { attributes: true, attributeFilter: ['style'] });
        }

        // Professional hover animation
        button.addEventListener('mouseenter', function() {
            gsap.to(this, {
                duration: 0.3,
                y: -3,
                boxShadow: '0 10px 30px rgba(0,0,0,0.3)',
                ease: 'power2.out'
            });
        });

        button.addEventListener('mouseleave', function() {
            gsap.to(this, {
                duration: 0.3,
                y: 0,
                boxShadow: '0 4px 6px rgba(0,0,0,0.1)',
                ease: 'power2.out'
            });
        });
    });

    // Subtle zoom effect for hero images
    heroImages.forEach(img => {
        gsap.from(img, {
            duration: 2,
            scale: 1.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: img,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    });
}

// ============================================
// LOGO ANIMATIONS
// ============================================
function initLogoAnimations() {
    // Only target logos with specific animation class to avoid conflicts
    const logos = document.querySelectorAll('.logo-animate, .brand-logo-animate');

    logos.forEach(logo => {
        // Skip navbar logos and profile images
        if (logo.closest('nav') || logo.closest('.profile')) return;

        // Professional entrance animation
        gsap.from(logo, {
            duration: 1,
            opacity: 0,
            scale: 0.8,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: logo,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });

        // Subtle hover animation
        logo.addEventListener('mouseenter', function() {
            gsap.to(this, {
                duration: 0.3,
                scale: 1.1,
                ease: 'power2.out'
            });
        });

        logo.addEventListener('mouseleave', function() {
            gsap.to(this, {
                duration: 0.3,
                scale: 1,
                ease: 'power2.out'
            });
        });
    });
}

// ============================================
// IMAGE ANIMATIONS
// ============================================
function initImageAnimations() {
    // Only animate images with specific animation classes
    const animateImages = document.querySelectorAll('.gsap-image-animate, .parallax-image');

    animateImages.forEach(img => {
        // Skip carousel images, navbar images, profile images, avatars
        if (img.closest('.carousel-slide') ||
            img.closest('nav') ||
            img.closest('.profile') ||
            img.closest('.avatar') ||
            img.alt.toLowerCase().includes('avatar') ||
            img.alt.toLowerCase().includes('profile')) {
            return;
        }

        // Reveal animation
        gsap.from(img, {
            duration: 1.2,
            opacity: 0,
            scale: 0.8,
            y: 50,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: img,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });

        // Parallax scroll effect only for parallax-image class
        if (img.classList.contains('parallax-image')) {
            gsap.to(img, {
                y: -30,
                ease: 'none',
                scrollTrigger: {
                    trigger: img,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1
                }
            });
        }

        // Image hover zoom
        img.addEventListener('mouseenter', function() {
            gsap.to(this, {
                duration: 0.5,
                scale: 1.05,
                ease: 'power2.out'
            });
        });

        img.addEventListener('mouseleave', function() {
            gsap.to(this, {
                duration: 0.5,
                scale: 1,
                ease: 'power2.out'
            });
        });
    });

    // Special reveal animation for featured images only
    const featuredImages = document.querySelectorAll('.featured-image, .highlight-image');
    featuredImages.forEach(img => {
        gsap.from(img, {
            duration: 1.5,
            clipPath: 'polygon(0 0, 0 0, 0 100%, 0 100%)',
            ease: 'power4.out',
            scrollTrigger: {
                trigger: img,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });

        gsap.set(img, {
            clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0 100%)'
        });
    });
}

// ============================================
// TEXT ANIMATIONS
// ============================================
function initTextAnimations() {
    // Only animate headings with specific animation class
    const headings = document.querySelectorAll('.gsap-heading-animate, section h2, section h3, section h4, .section-title');

    headings.forEach(heading => {
        // Skip if in navbar or already has carousel animations
        if (heading.closest('nav') || heading.closest('.carousel-slide')) return;

        gsap.from(heading, {
            duration: 1,
            opacity: 0,
            y: 30,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: heading,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    // Only animate paragraphs with specific animation class
    const paragraphs = document.querySelectorAll('.gsap-text-animate, section p, .description, .text-content');

    paragraphs.forEach(p => {
        // Skip if in navbar, carousel, or navigation elements
        if (p.closest('nav') || p.closest('.carousel-slide') || p.closest('header')) return;

        gsap.from(p, {
            duration: 0.8,
            opacity: 0,
            y: 20,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: p,
                start: 'top 90%',
                toggleActions: 'play none none none'
            }
        });
    });

    // Only animate lists with specific animation class
    const lists = document.querySelectorAll('.gsap-list-animate, section ul, section ol');

    lists.forEach(list => {
        // Skip if in navbar or navigation
        if (list.closest('nav') || list.closest('header')) return;

        const items = list.querySelectorAll('li');

        gsap.from(items, {
            duration: 0.6,
            opacity: 0,
            x: -30,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: list,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });
}

// ============================================
// SCROLL-TRIGGERED ANIMATIONS
// ============================================
function initScrollAnimations() {
    // Only animate sections with specific animation class
    const sections = document.querySelectorAll('.gsap-section-animate, main section, .content-block');

    sections.forEach(section => {
        // Skip navigation and header sections
        if (section.closest('nav') || section.closest('header')) return;

        gsap.from(section, {
            duration: 1,
            opacity: 0,
            y: 50,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: section,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    });

    // Counter animations - only for elements with data-counter attribute
    const counters = document.querySelectorAll('[data-counter]');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-counter'));

        ScrollTrigger.create({
            trigger: counter,
            start: 'top 80%',
            onEnter: () => {
                gsap.to(counter, {
                    duration: 2,
                    textContent: target,
                    roundProps: 'textContent',
                    ease: 'power1.out'
                });
            }
        });
    });
}

// ============================================
// CARD ANIMATIONS
// ============================================
function initCardAnimations() {
    // Only animate cards with specific animation class or card-interactive class
    const cards = document.querySelectorAll('.gsap-card-animate, .card-interactive');

    cards.forEach((card, index) => {
        // Entrance animation
        gsap.from(card, {
            duration: 0.8,
            opacity: 0,
            y: 40,
            scale: 0.9,
            ease: 'back.out(1.7)',
            delay: index * 0.1,
            scrollTrigger: {
                trigger: card,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });

        // Only add 3D effect if card has the interactive class
        if (card.classList.contains('card-interactive') || card.classList.contains('gsap-3d-card')) {
            // 3D hover effect
            card.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;

                gsap.to(this, {
                    duration: 0.3,
                    rotationX: rotateX,
                    rotationY: rotateY,
                    transformPerspective: 1000,
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    duration: 0.5,
                    rotationX: 0,
                    rotationY: 0,
                    ease: 'power2.out'
                });
            });

            // Lift on hover
            card.addEventListener('mouseenter', function() {
                gsap.to(this, {
                    duration: 0.3,
                    y: -10,
                    boxShadow: '0 20px 40px rgba(0,0,0,0.2)',
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    duration: 0.3,
                    y: 0,
                    boxShadow: '0 4px 6px rgba(0,0,0,0.1)',
                    ease: 'power2.out'
                });
            });
        }
    });
}

// ============================================
// BUTTON ANIMATIONS
// ============================================
function initButtonAnimations() {
    // Only add ripple effect to buttons with specific class
    const buttons = document.querySelectorAll('.gsap-ripple-btn, .btn-ripple');

    buttons.forEach(button => {
        // Ripple effect on click
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.className = 'gsap-ripple';
            this.appendChild(ripple);

            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            gsap.set(ripple, {
                width: size,
                height: size,
                left: x,
                top: y,
                position: 'absolute',
                borderRadius: '50%',
                backgroundColor: 'rgba(255,255,255,0.6)',
                pointerEvents: 'none'
            });

            gsap.to(ripple, {
                duration: 0.6,
                scale: 2,
                opacity: 0,
                ease: 'power2.out',
                onComplete: () => ripple.remove()
            });
        });
    });
}

// ============================================
// NAVBAR ANIMATIONS
// ============================================
function initNavbarAnimations() {
    const navbar = document.querySelector('nav');
    if (!navbar) return;

    // Check if this is a public navbar (has bg-blue-900) or authenticated navbar
    const isPublicNav = navbar.classList.contains('bg-blue-900');

    if (isPublicNav) {
        // PUBLIC NAVBAR: Fixed with transparent/solid state
        let ticking = false;

        const updatePublicNavbar = () => {
            const scrollY = window.pageYOffset;

            if (scrollY > 50) {
                // Scrolled down - add solid background and shadow
                navbar.classList.add('navbar-scrolled');
                gsap.to(navbar, {
                    duration: 0.3,
                    boxShadow: '0 4px 20px rgba(0,0,0,0.3)',
                    ease: 'power2.out'
                });
            } else {
                // At top - remove background, make transparent
                navbar.classList.remove('navbar-scrolled');
                gsap.to(navbar, {
                    duration: 0.3,
                    boxShadow: '0 0 0 rgba(0,0,0,0)',
                    ease: 'power2.out'
                });
            }

            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(updatePublicNavbar);
                ticking = true;
            }
        });

        // Initial check on load
        updatePublicNavbar();

    } else {
        // AUTHENTICATED NAVBAR: Hide/show on scroll
        let lastScroll = 0;
        let ticking = false;

        const updateNavbar = () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > lastScroll && currentScroll > 300) {
                // Scrolling down - hide navbar
                gsap.to(navbar, {
                    duration: 0.4,
                    y: -100,
                    ease: 'power3.out'
                });
            } else if (currentScroll < lastScroll) {
                // Scrolling up - show navbar
                gsap.to(navbar, {
                    duration: 0.4,
                    y: 0,
                    ease: 'power3.out'
                });
            }

            lastScroll = currentScroll;
            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        });

        // Add shadow on scroll for authenticated navbar
        ScrollTrigger.create({
            start: 'top -10',
            end: 99999,
            onEnter: () => {
                gsap.to(navbar, {
                    duration: 0.3,
                    boxShadow: '0 2px 10px rgba(0,0,0,0.1)',
                    ease: 'power2.out'
                });
            },
            onLeaveBack: () => {
                gsap.to(navbar, {
                    duration: 0.3,
                    boxShadow: '0 0 0 rgba(0,0,0,0)',
                    ease: 'power2.out'
                });
            }
        });
    }

    // DISABLED: Navbar logo and link animations to prevent conflicts
    // Logo and navigation items will use their default styling

    // Only animate elements with specific animation classes in navbar
    const animateElements = navbar.querySelectorAll('.gsap-nav-animate');
    if (animateElements.length > 0) {
        gsap.from(animateElements, {
            duration: 0.6,
            opacity: 0,
            y: -20,
            stagger: 0.05,
            ease: 'power2.out',
            delay: 0.3
        });
    }
}

// Export functions for external use
export {
    initHeroAnimations,
    initLogoAnimations,
    initImageAnimations,
    initTextAnimations,
    initScrollAnimations,
    initCardAnimations,
    initButtonAnimations,
    initNavbarAnimations
};
