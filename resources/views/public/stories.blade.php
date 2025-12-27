@extends('layouts.public')

@section('title', 'Student Stories')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Campus Life', 'url' => '#'],
    ['label' => 'Student Stories', 'icon' => 'fas fa-user-graduate']
]" />

<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Student Stories</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Real experiences and achievements from our amazing students
            </p>
        </div>
    </div>
</section>

<!-- Stories Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Filter Form -->
        <div class="mb-8">
            <form action="{{ route('stories') }}" method="GET" class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-3 gap-4">
                    <!-- Search Input -->
                    <div class="md:col-span-2 relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search stories by name, title, or content..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                    </div>

                    <!-- Grade Filter -->
                    <div class="relative">
                        <select
                            name="grade"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm appearance-none">
                            <option value="">All Grades</option>
                            <option value="Grade 1" {{ request('grade') == 'Grade 1' ? 'selected' : '' }}>Grade 1</option>
                            <option value="Grade 2" {{ request('grade') == 'Grade 2' ? 'selected' : '' }}>Grade 2</option>
                            <option value="Grade 3" {{ request('grade') == 'Grade 3' ? 'selected' : '' }}>Grade 3</option>
                            <option value="Grade 4" {{ request('grade') == 'Grade 4' ? 'selected' : '' }}>Grade 4</option>
                            <option value="Grade 5" {{ request('grade') == 'Grade 5' ? 'selected' : '' }}>Grade 5</option>
                            <option value="Grade 6" {{ request('grade') == 'Grade 6' ? 'selected' : '' }}>Grade 6</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Search Actions -->
                <div class="mt-4 flex justify-center gap-3">
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-2.5 rounded-lg font-semibold transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                    @if(request('search') || request('grade'))
                    <a href="{{ route('stories') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-2.5 rounded-lg font-semibold transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Clear
                    </a>
                    @endif
                </div>

                @if(request('search') || request('grade'))
                <div class="mt-3 text-center text-sm text-gray-600">
                    <span>Showing filtered results</span>
                    @if(request('search'))
                    <span>for "<strong>{{ request('search') }}</strong>"</span>
                    @endif
                    @if(request('grade'))
                    <span>in <strong>{{ request('grade') }}</strong></span>
                    @endif
                </div>
                @endif
            </form>
        </div>

        @if($stories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($stories as $story)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <!-- Story Image -->
                    @if($story->image)
                        <div class="cursor-pointer group relative"
                             onclick="openImageModal('{{ asset('storage/' . $story->image) }}', '{{ $story->title }}')">
                            <x-responsive-image
                                :src="$story->image"
                                :alt="$story->title"
                                class="w-full h-48 object-cover"
                                :lazy="true" />
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                        </div>
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                            <i class="fas fa-user-graduate text-6xl text-blue-400"></i>
                        </div>
                    @endif

                    <!-- Story Content -->
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold bg-primary-100 text-primary-800 rounded-full">
                                {{ $story->grade_level }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $story->title }}</h3>
                        <p class="text-sm text-gray-600 mb-3">
                            <i class="fas fa-user mr-1"></i>{{ $story->student_name }}
                        </p>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $story->excerpt }}</p>
                        <button onclick="openStoryModal({{ $story->id }})"
                                class="text-primary-600 hover:text-primary-800 font-semibold">
                            Read More <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <x-pagination-info :paginator="$stories" class="rounded-lg shadow-sm" />
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-{{ request('search') || request('grade') ? 'search' : 'user-graduate' }} text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">
                    {{ request('search') || request('grade') ? 'No Results Found' : 'No Stories Yet' }}
                </h3>
                <p class="text-gray-600 max-w-md mx-auto mb-6">
                    @if(request('search') || request('grade'))
                        We couldn't find any stories matching your filters. Try different keywords or clear your filters.
                    @else
                        There are currently no student stories to display. Please check back later.
                    @endif
                </p>
                @if(request('search') || request('grade'))
                    <a href="{{ route('stories') }}" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                        <i class="fas fa-times mr-2"></i>Clear Filters
                    </a>
                @else
                    <a href="{{ route('home') }}" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                        Return to Home
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Story Modal -->
<div id="storyModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 id="modalTitle" class="text-2xl font-bold text-gray-900"></h2>
                <button onclick="closeStoryModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div class="mb-4">
                <span id="modalGrade" class="inline-block px-3 py-1 text-sm font-semibold bg-primary-100 text-primary-800 rounded-full"></span>
            </div>
            <p id="modalStudent" class="text-gray-600 mb-4"></p>
            <div id="modalImageWrapper" class="hidden mb-4 cursor-pointer group relative" onclick="openModalStoryImage()">
                <img id="modalImage" src="" alt="" class="w-full rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center rounded-lg">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
            <div id="modalContent" class="text-gray-700 leading-relaxed whitespace-pre-line mb-6"></div>

            <!-- Reactions Section -->
            <div class="border-t pt-4 mb-6">
                <button id="reactionButton" onclick="toggleReaction()" class="flex items-center gap-2 text-gray-600 hover:text-red-500 transition-colors">
                    <i id="reactionIcon" class="far fa-heart text-2xl"></i>
                    <span id="reactionCount" class="font-semibold">0</span>
                </button>
            </div>

            <!-- Comments Section -->
            <div class="border-t pt-4">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Comments</h3>

                <!-- Comment Form -->
                <form id="commentForm" onsubmit="submitComment(event)" class="mb-6">
                    <div class="space-y-3">
                        @guest
                        <div>
                            <input type="text" id="commenterName" name="commenter_name" required placeholder="Your Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        <div>
                            <input type="email" id="commenterEmail" name="commenter_email" placeholder="Your Email (optional)" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        @endguest
                        <div>
                            <textarea id="commentText" name="comment" required rows="3" placeholder="Write your comment..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
                        </div>
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-comment mr-2"></i>Submit Comment
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Your comment will be reviewed by an admin before being published.</p>
                </form>

                <!-- Comments List -->
                <div id="commentsList" class="space-y-4">
                    <!-- Comments will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const stories = @json($stories->items());
    let currentStoryId = null;

    function openStoryModal(id) {
        const story = stories.find(s => s.id === id);
        if (!story) return;

        currentStoryId = id;

        document.getElementById('modalTitle').textContent = story.title;
        document.getElementById('modalGrade').textContent = story.grade_level;
        document.getElementById('modalStudent').innerHTML = '<i class="fas fa-user mr-1"></i>' + story.student_name;
        document.getElementById('modalContent').textContent = story.content;

        const modalImage = document.getElementById('modalImage');
        const modalImageWrapper = document.getElementById('modalImageWrapper');
        if (story.image) {
            modalImage.src = '/storage/' + story.image;
            modalImage.alt = story.title;
            modalImageWrapper.classList.remove('hidden');
        } else {
            modalImageWrapper.classList.add('hidden');
        }

        // Load reactions and comments
        loadReactionStatus(id);
        loadComments(id);

        document.getElementById('storyModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeStoryModal() {
        document.getElementById('storyModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentStoryId = null;
        document.getElementById('commentForm').reset();
    }

    // Load reaction status
    function loadReactionStatus(storyId) {
        const story = stories.find(s => s.id === storyId);
        if (!story) return;

        // Set initial count (you can add this to the story data from backend)
        const reactionCount = story.reaction_count || 0;
        const hasReacted = story.has_user_reacted || false;

        document.getElementById('reactionCount').textContent = reactionCount;
        const reactionIcon = document.getElementById('reactionIcon');
        if (hasReacted) {
            reactionIcon.classList.remove('far');
            reactionIcon.classList.add('fas', 'text-red-500');
        } else {
            reactionIcon.classList.remove('fas', 'text-red-500');
            reactionIcon.classList.add('far');
        }
    }

    // Toggle reaction
    function toggleReaction() {
        if (!currentStoryId) return;

        fetch(`/stories/${currentStoryId}/react`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ type: 'like' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('reactionCount').textContent = data.count;
                const reactionIcon = document.getElementById('reactionIcon');
                if (data.reacted) {
                    reactionIcon.classList.remove('far');
                    reactionIcon.classList.add('fas', 'text-red-500');
                } else {
                    reactionIcon.classList.remove('fas', 'text-red-500');
                    reactionIcon.classList.add('far');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Load comments
    function loadComments(storyId) {
        fetch(`/stories/${storyId}/comments`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const commentsList = document.getElementById('commentsList');
                    if (data.comments.length === 0) {
                        commentsList.innerHTML = '<p class="text-gray-500 text-center py-4">No comments yet. Be the first to comment!</p>';
                    } else {
                        commentsList.innerHTML = data.comments.map(comment => `
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-semibold">${comment.commenter_name.charAt(0).toUpperCase()}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-semibold text-gray-900">${comment.commenter_name}</span>
                                            <span class="text-xs text-gray-500">${comment.created_at}</span>
                                        </div>
                                        <p class="text-gray-700">${comment.comment}</p>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Submit comment
    function submitComment(event) {
        event.preventDefault();
        if (!currentStoryId) return;

        const formData = new FormData(event.target);
        const data = {
            comment: formData.get('comment'),
        };

        // Add name and email for guests
        const commenterName = document.getElementById('commenterName');
        if (commenterName) {
            data.commenter_name = formData.get('commenter_name');
            data.commenter_email = formData.get('commenter_email') || '';
        }

        fetch(`/stories/${currentStoryId}/comment`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message || 'Your comment has been submitted and is pending approval.');
                document.getElementById('commentForm').reset();
            } else {
                alert('Error submitting comment. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error submitting comment. Please try again.');
        });
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeStoryModal();
    });

    // Close modal on backdrop click
    document.getElementById('storyModal').addEventListener('click', function(e) {
        if (e.target === this) closeStoryModal();
    });

    // Open story image in image modal
    function openModalStoryImage() {
        const modalImage = document.getElementById('modalImage');
        openImageModal(modalImage.src, modalImage.alt);
    }
</script>
@endpush
@endsection
