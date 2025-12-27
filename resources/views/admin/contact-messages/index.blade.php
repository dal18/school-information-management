@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Contact Messages</h1>
        <p class="text-gray-600 mt-1">View and respond to contact form submissions</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Status Filters -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
            <!-- Status Filter Tabs -->
            <div class="flex items-center space-x-2 overflow-x-auto">
                <a href="{{ route('admin.contact-messages.index', ['status' => 'all']) }}"
                   class="px-4 py-2 rounded-lg font-medium transition {{ request('status', 'all') === 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('status', 'all') === 'all' ? 'bg-white text-primary-600' : 'bg-gray-200' }}">{{ $counts['all'] }}</span>
                </a>
                <a href="{{ route('admin.contact-messages.index', ['status' => 'unread']) }}"
                   class="px-4 py-2 rounded-lg font-medium transition {{ request('status') === 'unread' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Unread <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('status') === 'unread' ? 'bg-white text-red-600' : 'bg-gray-200' }}">{{ $counts['unread'] }}</span>
                </a>
                <a href="{{ route('admin.contact-messages.index', ['status' => 'read']) }}"
                   class="px-4 py-2 rounded-lg font-medium transition {{ request('status') === 'read' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Read <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('status') === 'read' ? 'bg-white text-blue-600' : 'bg-gray-200' }}">{{ $counts['read'] }}</span>
                </a>
                <a href="{{ route('admin.contact-messages.index', ['status' => 'responded']) }}"
                   class="px-4 py-2 rounded-lg font-medium transition {{ request('status') === 'responded' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Responded <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('status') === 'responded' ? 'bg-white text-green-600' : 'bg-gray-200' }}">{{ $counts['responded'] }}</span>
                </a>
            </div>

            <!-- Search -->
            <div class="flex-1 max-w-md ml-0 md:ml-4">
                <form action="{{ route('admin.contact-messages.index') }}" method="GET">
                    <input type="hidden" name="status" value="{{ request('status', 'all') }}">
                    <div class="relative">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search messages..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Messages List -->
    <div class="overflow-x-auto">
        @if($messages->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            From
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Message Preview
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($messages as $message)
                    <tr class="hover:bg-gray-50 {{ $message->status === 'unread' ? 'bg-blue-50' : '' }}">
                        <!-- Status Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($message->status === 'unread')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-circle text-red-500 mr-1 text-xs"></i> Unread
                                </span>
                            @elseif($message->status === 'read')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-eye mr-1"></i> Read
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Replied
                                </span>
                            @endif
                        </td>

                        <!-- From -->
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $message->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $message->email }}
                                    </div>
                                    @if($message->phone)
                                        <div class="text-xs text-gray-400">
                                            <i class="fas fa-phone mr-1"></i>{{ $message->phone }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- Subject -->
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ Str::limit($message->subject, 40) }}
                            </div>
                        </td>

                        <!-- Message Preview -->
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600">
                                {{ Str::limit($message->message, 60) }}
                            </div>
                        </td>

                        <!-- Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $message->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $message->created_at->format('h:i A') }}</div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.contact-messages.show', $message) }}"
                                   class="text-primary-600 hover:text-primary-900"
                                   title="View Message">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.contact-messages.destroy', $message) }}"
                                      method="POST"
                                      class="inline"
                                      id="delete-form-{{ $message->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="confirmDelete('delete-form-{{ $message->id }}', 'Are you sure you want to delete this message?', 'Delete Message?')"
                                            class="text-red-600 hover:text-red-900"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $messages->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No messages found</h3>
                <p class="text-gray-500">
                    @if(request('search'))
                        No messages match your search criteria.
                    @elseif(request('status') && request('status') !== 'all')
                        No {{ request('status') }} messages at this time.
                    @else
                        There are no contact messages yet.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
