@extends('layouts.admin')

@section('title', 'My Contact Messages')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">My Contact Messages</h1>
    <p class="text-gray-600 mt-1">View your contact messages and admin replies</p>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 m-6 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($messages->isEmpty())
        <div class="text-center py-16">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <p class="text-xl text-gray-600 mb-2">No Contact Messages</p>
            <p class="text-gray-500 mb-6">You haven't sent any contact messages yet.</p>
            <a href="{{ route('contact') }}"
               class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                <i class="fas fa-envelope mr-2"></i>Send a Message
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date Sent
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($messages as $message)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($message->admin_reply && !$message->user_has_seen_reply)
                                        <div class="flex-shrink-0 mr-2">
                                            <span class="inline-flex items-center justify-center h-2 w-2 rounded-full bg-blue-500"></span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $message->subject }}
                                        </div>
                                        <div class="text-sm text-gray-500 truncate max-w-md">
                                            {{ Str::limit($message->message, 60) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $message->created_at ? $message->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($message->status === 'responded')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-reply mr-1"></i>Replied
                                    </span>
                                    @if(!$message->user_has_seen_reply)
                                        <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            New
                                        </span>
                                    @endif
                                @elseif($message->status === 'read')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-eye mr-1"></i>Read
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('student.contact-messages.show', $message) }}"
                                   class="text-primary-600 hover:text-primary-900">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $messages->links() }}
        </div>
    @endif
</div>

<div class="mt-6">
    <a href="{{ route('contact') }}"
       class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
        <i class="fas fa-plus mr-2"></i>Send New Message
    </a>
</div>
@endsection
