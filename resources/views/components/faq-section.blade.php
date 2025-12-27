@props(['faqs' => []])

<!-- FAQ Section -->
<section class="py-16 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                <i class="fas fa-question-circle mr-2"></i>FAQ
            </span>
            <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-4">
                Frequently Asked Questions
            </h2>
            <p class="text-xl text-gray-600">
                Find answers to common questions about our school
            </p>
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-4" x-data="{ activeIndex: null }">
            @foreach($faqs as $index => $faq)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-md">
                <!-- Question -->
                <button
                    @click="activeIndex = activeIndex === {{ $index }} ? null : {{ $index }}"
                    class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 hover:bg-gray-50 transition-colors duration-200"
                >
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-question text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 flex-1">
                            {{ $faq['question'] }}
                        </h3>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300"
                           :class="{ 'rotate-180': activeIndex === {{ $index }} }"></i>
                    </div>
                </button>

                <!-- Answer -->
                <div
                    x-show="activeIndex === {{ $index }}"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="overflow-hidden"
                    style="display: none;"
                >
                    <div class="px-6 pb-5 pl-20">
                        <p class="text-gray-600 leading-relaxed">
                            {{ $faq['answer'] }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Still Have Questions CTA -->
        <div class="mt-12 text-center bg-primary-50 rounded-2xl p-8 border border-primary-100">
            <i class="fas fa-headset text-4xl text-primary-600 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Still have questions?</h3>
            <p class="text-gray-600 mb-6">
                Can't find the answer you're looking for? Please contact our friendly team.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Us
                </a>
                <a href="tel:+1234567890" class="inline-flex items-center justify-center bg-white hover:bg-gray-50 text-primary-600 font-semibold px-6 py-3 rounded-lg border-2 border-primary-600 transition-colors duration-200">
                    <i class="fas fa-phone mr-2"></i>
                    Call Us
                </a>
            </div>
        </div>
    </div>
</section>
