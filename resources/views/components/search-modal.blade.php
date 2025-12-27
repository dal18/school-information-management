<!-- Search Modal -->
<div>
    <div x-data="searchModal()"
         x-init="init()"
         @keydown.escape.window="closeModal()"
         @open-search.window="openModal()">

        <!-- Modal Backdrop & Container -->
        <div x-show="isOpen"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
                 @click="closeModal()"></div>

            <!-- Modal Dialog -->
            <div class="flex min-h-screen items-start justify-center p-4 pt-20">
                <div x-show="isOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.stop
                     class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden">

                    <!-- Search Input -->
                    <div class="p-4 border-b border-gray-200">
                        <form @submit.prevent="submitSearch()">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                                <input
                                    x-ref="searchInput"
                                    x-model="searchQuery"
                                    @input="handleSearch()"
                                    type="text"
                                    placeholder="Search for courses, posts, announcements..."
                                    class="w-full pl-12 pr-12 py-4 text-lg border-0 focus:ring-0 focus:outline-none"
                                    autocomplete="off">

                                <!-- Loading Spinner -->
                                <div x-show="isLoading" class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                    <i class="fas fa-spinner fa-spin text-primary-600"></i>
                                </div>

                                <!-- Clear Button -->
                                <button
                                    x-show="searchQuery.length > 0 && !isLoading"
                                    @click="clearSearch()"
                                    type="button"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Search Results -->
                    <div class="max-h-96 overflow-y-auto">
                        <!-- Results List -->
                        <div x-show="searchResults.length > 0" class="py-2">
                            <template x-for="result in searchResults" :key="result.url">
                                <a :href="result.url"
                                   class="block px-6 py-3 hover:bg-gray-50 transition-colors duration-200">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i :class="'fas ' + result.icon" class="text-primary-600"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-gray-900 font-medium truncate" x-text="result.title"></p>
                                            <p class="text-sm text-gray-500" x-text="result.type"></p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-400 text-sm"></i>
                                    </div>
                                </a>
                            </template>

                            <!-- View All Results -->
                            <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
                                <button @click="submitSearch()"
                                        type="button"
                                        class="w-full text-center text-primary-600 hover:text-primary-700 font-semibold py-2">
                                    View all results for "<span x-text="searchQuery"></span>"
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- No Results -->
                        <div x-show="searchQuery.length >= 2 && searchResults.length === 0 && !isLoading"
                             class="py-12 text-center">
                            <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">No results found</p>
                            <p class="text-gray-400 text-sm">Try different keywords</p>
                        </div>

                        <!-- Empty State -->
                        <div x-show="searchQuery.length === 0" class="py-12 px-6">
                            <p class="text-gray-400 text-center mb-6">Start typing to search...</p>
                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('courses') }}" class="p-4 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-colors duration-200">
                                    <i class="fas fa-book text-primary-600 text-xl mb-2"></i>
                                    <p class="font-medium text-gray-900 text-sm">Courses</p>
                                </a>
                                <a href="{{ route('announcements') }}" class="p-4 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-colors duration-200">
                                    <i class="fas fa-bullhorn text-primary-600 text-xl mb-2"></i>
                                    <p class="font-medium text-gray-900 text-sm">Announcements</p>
                                </a>
                                <a href="{{ route('blog') }}" class="p-4 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-colors duration-200">
                                    <i class="fas fa-newspaper text-primary-600 text-xl mb-2"></i>
                                    <p class="font-medium text-gray-900 text-sm">Blog</p>
                                </a>
                                <a href="{{ route('activities') }}" class="p-4 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-colors duration-200">
                                    <i class="fas fa-running text-primary-600 text-xl mb-2"></i>
                                    <p class="font-medium text-gray-900 text-sm">Activities</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Close Button -->
                    <button type="button"
                            @click="closeModal()"
                            class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-times text-gray-400"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function searchModal() {
    return {
        isOpen: false,
        searchQuery: '',
        searchResults: [],
        isLoading: false,
        searchTimeout: null,

        init() {
            console.log('Search modal initialized');
        },

        openModal() {
            console.log('Opening search modal');
            this.isOpen = true;
            this.$nextTick(() => {
                if (this.$refs.searchInput) {
                    this.$refs.searchInput.focus();
                }
            });
        },

        closeModal() {
            console.log('Closing search modal');
            this.isOpen = false;
            this.clearSearch();
        },

        clearSearch() {
            this.searchQuery = '';
            this.searchResults = [];
            this.isLoading = false;
        },

        handleSearch() {
            if (this.searchQuery.length < 2) {
                this.searchResults = [];
                return;
            }

            clearTimeout(this.searchTimeout);
            this.isLoading = true;

            this.searchTimeout = setTimeout(() => {
                this.performSearch();
            }, 300);
        },

        async performSearch() {
            try {
                const response = await fetch('{{ route('search.autocomplete') }}?q=' + encodeURIComponent(this.searchQuery));
                const data = await response.json();
                this.searchResults = data;
                console.log('Search results:', this.searchResults);
            } catch (error) {
                console.error('Search error:', error);
                this.searchResults = [];
            } finally {
                this.isLoading = false;
            }
        },

        submitSearch() {
            if (this.searchQuery.trim()) {
                window.location.href = '{{ route('search') }}?q=' + encodeURIComponent(this.searchQuery);
            }
        }
    }
}
</script>
