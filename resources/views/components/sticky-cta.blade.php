<!-- Sticky Apply Now CTA Button -->
<div x-data="{
    show: false,
    init() {
        window.addEventListener('scroll', () => {
            this.show = window.scrollY > 800;
        });
    }
}"
x-show="show"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 translate-y-4"
x-transition:enter-end="opacity-100 translate-y-0"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100 translate-y-0"
x-transition:leave-end="opacity-0 translate-y-4"
class="fixed bottom-6 right-6 z-40"
style="display: none;">

    <!-- Main CTA Button -->
    <a href="{{ route('admissions') }}"
       class="group flex items-center gap-3 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white px-6 py-4 rounded-full shadow-2xl hover:shadow-accent-500/50 transition-all duration-300 transform hover:scale-105">

        <!-- Icon -->
        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
            <i class="fas fa-graduation-cap text-xl"></i>
        </div>

        <!-- Text -->
        <div class="hidden md:block">
            <div class="text-sm font-bold leading-tight">Apply Now</div>
            <div class="text-xs opacity-90">Start Your Journey</div>
        </div>

        <!-- Arrow -->
        <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
    </a>

    <!-- Mobile Version (Icon Only) -->
    <a href="{{ route('admissions') }}"
       class="md:hidden flex items-center justify-center w-14 h-14 bg-gradient-to-br from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white rounded-full shadow-2xl hover:shadow-accent-500/50 transition-all duration-300 transform hover:scale-110">
        <i class="fas fa-graduation-cap text-xl"></i>
    </a>
</div>
