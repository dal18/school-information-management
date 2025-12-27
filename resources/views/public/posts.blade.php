@extends('layouts.public')

@section('title', 'News & Blog')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'News & Stories', 'url' => '#'],
    ['label' => 'Blog Posts', 'icon' => 'fas fa-newspaper']
]" />

<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">News & Blog</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Stay updated with the latest news, events, and stories from our school
            </p>
        </div>
    </div>
</section>

<!-- Posts Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Form -->
        <div class="mb-8">
            <form action="{{ route('blog') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search blog posts..."
                        class="w-full pl-12 pr-24 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors duration-200">
                        Search
                    </button>
                </div>
                @if(request('search'))
                <div class="mt-2 text-center">
                    <span class="text-sm text-gray-600">
                        Showing results for "<strong>{{ request('search') }}</strong>"
                    </span>
                    <a href="{{ route('blog') }}" class="ml-3 text-sm text-primary-600 hover:text-primary-700 font-medium">
                        Clear search
                    </a>
                </div>
                @endif
            </form>
        </div>

        @if($posts->count() > 0)
            <div class="space-y-8">
                @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="p-8">
                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                            <span>
                                <i class="fas fa-user mr-1"></i>
                                {{ $post->author ? $post->author->name : 'Admin' }}
                            </span>
                            <span>
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                            <span>
                                <i class="fas fa-clock mr-1"></i>
                                {{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h2>

                        <div class="prose max-w-none text-gray-700 mb-6 leading-relaxed">
                            @if(strlen($post->content) > 500)
                                <div class="whitespace-pre-line">{{ Str::limit($post->content, 500) }}</div>
                                <button onclick="toggleContent({{ $post->id }})"
                                        class="text-primary-600 hover:text-primary-800 font-semibold mt-3 inline-flex items-center"
                                        id="readMoreBtn{{ $post->id }}">
                                    Read More <i class="fas fa-chevron-down ml-2"></i>
                                </button>
                                <div id="fullContent{{ $post->id }}" class="hidden">
                                    <div class="whitespace-pre-line mt-4">{{ substr($post->content, 500) }}</div>
                                    <button onclick="toggleContent({{ $post->id }})"
                                            class="text-primary-600 hover:text-primary-800 font-semibold mt-3 inline-flex items-center">
                                        Read Less <i class="fas fa-chevron-up ml-2"></i>
                                    </button>
                                </div>
                            @else
                                <div class="whitespace-pre-line">{{ $post->content }}</div>
                            @endif
                        </div>

                        <!-- Reactions Section -->
                        <div class="pt-4 border-t border-gray-200 mb-4">
                            <div class="flex items-center justify-between">
                                <button onclick="toggleReaction({{ $post->id }})"
                                        id="reactionButton{{ $post->id }}"
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200 hover:bg-red-50 {{ $post->has_user_reacted ? 'text-red-500' : 'text-gray-600' }}">
                                    <i id="reactionIcon{{ $post->id }}"
                                       class="{{ $post->has_user_reacted ? 'fas' : 'far' }} fa-heart text-2xl"></i>
                                    <span id="reactionCount{{ $post->id }}" class="font-semibold text-lg">{{ $post->reaction_count }}</span>
                                </button>
                                <div class="flex items-center space-x-4">
                                    <button onclick="showCommentForm({{ $post->id }})"
                                            class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                                        <i class="far fa-comment"></i>
                                        <span>Comment</span>
                                    </button>
                                    <button class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                                        <i class="fas fa-share"></i>
                                        <span>Share</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Comment Form (Hidden by default) -->
                        <div id="commentForm{{ $post->id }}" class="hidden mb-4 bg-gray-50 rounded-lg p-4">
                            <form onsubmit="submitComment(event, {{ $post->id }})">
                                @csrf
                                @guest
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                    <input type="text"
                                           id="commenterName{{ $post->id }}"
                                           name="commenter_name"
                                           required
                                           placeholder="Your Name"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    <input type="email"
                                           id="commenterEmail{{ $post->id }}"
                                           name="commenter_email"
                                           placeholder="Your Email (optional)"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                @endguest
                                <textarea id="commentText{{ $post->id }}"
                                          name="comment"
                                          required
                                          rows="3"
                                          placeholder="Write your comment..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 mb-3"></textarea>
                                <div class="flex gap-2">
                                    <button type="submit"
                                            class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition duration-300">
                                        <i class="fas fa-paper-plane mr-2"></i>Submit Comment
                                    </button>
                                    <button type="button"
                                            onclick="hideCommentForm({{ $post->id }})"
                                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition duration-300">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Comments Display -->
                        <div id="commentsSection{{ $post->id }}" class="space-y-3">
                            <!-- Comments will be loaded here -->
                        </div>

                        <div class="pt-4 border-t border-gray-200 mt-4">
                            <div class="text-sm text-gray-500 text-center">
                                Post ID: #{{ str_pad($post->id, 5, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <x-pagination-info :paginator="$posts" class="mt-8" />
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-{{ request('search') ? 'search' : 'newspaper' }} text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">
                    {{ request('search') ? 'No Results Found' : 'No Posts Yet' }}
                </h3>
                <p class="text-gray-600 max-w-md mx-auto mb-6">
                    @if(request('search'))
                        We couldn't find any blog posts matching "{{ request('search') }}". Try different keywords or clear your search.
                    @else
                        There are currently no blog posts to display. Please check back later for updates.
                    @endif
                </p>
                @if(request('search'))
                    <a href="{{ route('blog') }}" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                        <i class="fas fa-times mr-2"></i>Clear Search
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

@push('scripts')
<script>
    function toggleContent(postId) {
        const fullContent = document.getElementById('fullContent' + postId);
        const readMoreBtn = document.getElementById('readMoreBtn' + postId);

        if (fullContent.classList.contains('hidden')) {
            fullContent.classList.remove('hidden');
            readMoreBtn.classList.add('hidden');
        } else {
            fullContent.classList.add('hidden');
            readMoreBtn.classList.remove('hidden');
        }
    }

    // Toggle reaction on a post
    function toggleReaction(postId) {
        fetch(`/blog/${postId}/react`, {
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
                const icon = document.getElementById(`reactionIcon${postId}`);
                const count = document.getElementById(`reactionCount${postId}`);
                const button = document.getElementById(`reactionButton${postId}`);

                if (data.reacted) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    button.classList.remove('text-gray-600');
                    button.classList.add('text-red-500');
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    button.classList.remove('text-red-500');
                    button.classList.add('text-gray-600');
                }
                count.textContent = data.count;
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Show comment form
    function showCommentForm(postId) {
        const form = document.getElementById(`commentForm${postId}`);
        form.classList.remove('hidden');
        loadComments(postId);
    }

    // Hide comment form
    function hideCommentForm(postId) {
        const form = document.getElementById(`commentForm${postId}`);
        form.classList.add('hidden');
    }

    // Submit a comment
    function submitComment(event, postId) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);

        const data = {
            comment: document.getElementById(`commentText${postId}`).value
        };

        @guest
        data.commenter_name = document.getElementById(`commenterName${postId}`).value;
        data.commenter_email = document.getElementById(`commenterEmail${postId}`)?.value || '';
        @endguest

        fetch(`/blog/${postId}/comment`, {
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
                alert(data.message);
                form.reset();
                hideCommentForm(postId);
            } else if (data.errors) {
                let errorMessage = 'Validation errors:\n';
                for (let field in data.errors) {
                    errorMessage += data.errors[field].join('\n') + '\n';
                }
                alert(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting your comment.');
        });
    }

    // Load approved comments
    function loadComments(postId) {
        fetch(`/blog/${postId}/comments`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const commentsSection = document.getElementById(`commentsSection${postId}`);
                    if (data.comments.length > 0) {
                        commentsSection.innerHTML = '<h4 class="font-semibold text-gray-900 mb-3 text-lg">Comments</h4>';
                        data.comments.forEach(comment => {
                            commentsSection.innerHTML += `
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-semibold flex-shrink-0">
                                            ${comment.commenter_name.charAt(0).toUpperCase()}
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-gray-900">${comment.commenter_name}</span>
                                                <span class="text-xs text-gray-500">${comment.created_at}</span>
                                            </div>
                                            <p class="text-gray-700 text-sm">${comment.comment}</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        commentsSection.innerHTML = '<p class="text-gray-500 text-sm italic">No comments yet. Be the first to comment!</p>';
                    }
                }
            })
            .catch(error => console.error('Error loading comments:', error));
    }

    // Load comments for all posts on page load
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($posts as $post)
        loadComments({{ $post->id }});
        @endforeach
    });
</script>
@endpush
@endsection
