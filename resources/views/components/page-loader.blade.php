<!-- UC-BCF Style Page Loader -->
<div id="page-loader" class="preloader">
    <div class="preloader-container">
        <!-- Outer Spinning Ring -->
        <div class="spinner-outer"></div>

        <!-- Inner Pulsing Circle -->
        <div class="spinner-inner"></div>

        <!-- School Logo -->
        <img src="{{ asset('images/logo.png') }}" alt="LFHS Logo" class="preloader-logo">
    </div>
</div>

<style>
/* Preloader Full Screen Overlay */
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    transition: opacity 0.5s ease-out;
}

/* Preloader Container */
.preloader-container {
    position: relative;
    width: 200px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Outer Spinning Ring - Blue color for LFHS */
.spinner-outer {
    position: absolute;
    width: 180px;
    height: 180px;
    border: 4px solid #e5e7eb;
    border-top-color: #1e40af;
    border-right-color: #1e40af;
    border-radius: 50%;
    animation: spin-scale 2s linear infinite;
}

/* Spin and Scale Animation (like UC-BCF) */
@keyframes spin-scale {
    0% {
        transform: rotate(0deg) scale(1);
    }
    50% {
        transform: rotate(180deg) scale(1.8);
    }
    100% {
        transform: rotate(360deg) scale(1);
    }
}

/* Inner Pulsing Circle */
.spinner-inner {
    position: absolute;
    width: 140px;
    height: 140px;
    border: 3px solid floralwhite;
    border-radius: 50%;
    background-color: rgba(30, 64, 175, 0.1);
    animation: pulse-scale 3s ease-in-out infinite;
}

/* Pulse Scale Animation */
@keyframes pulse-scale {
    0%, 100% {
        transform: scale(1);
        opacity: 0.3;
    }
    50% {
        transform: scale(2);
        opacity: 0.1;
    }
}

/* School Logo in Center */
.preloader-logo {
    position: absolute;
    width: 100px;
    height: 100px;
    object-fit: contain;
    z-index: 10;
    animation: logo-pulse 2s ease-in-out infinite;
}

/* Logo Pulse Animation */
@keyframes logo-pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.8;
    }
}

/* Fade Out Animation */
.preloader.fade-out {
    opacity: 0;
    pointer-events: none;
}
</style>

<script>
// Hide loader when page is fully loaded
window.addEventListener('load', function() {
    const loader = document.getElementById('page-loader');
    if (loader) {
        setTimeout(() => {
            loader.classList.add('fade-out');
            setTimeout(() => {
                loader.remove();
            }, 500);
        }, 300);
    }
});

// Fallback: Hide after 5 seconds
setTimeout(function() {
    const loader = document.getElementById('page-loader');
    if (loader) {
        loader.classList.add('fade-out');
        setTimeout(() => {
            loader.remove();
        }, 500);
    }
}, 5000);
</script>
