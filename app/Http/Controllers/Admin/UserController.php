<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('user_name', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('access_rights', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $users = $query->orderBy('id', 'desc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => 'required|string|max:255',
            'midle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'access_rights' => 'required|in:Admin,Student,Teacher,Staff',
            'is_active' => 'boolean',
            'profile_image' => ['nullable', ...FileUploadService::getImageRules()],
        ]);

        $userData = [
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'first_name' => $validated['first_name'],
            'midle_name' => $validated['midle_name'] ?? '',
            'middle_name' => $validated['midle_name'] ?? '',
            'last_name' => $validated['last_name'],
            'access_rights' => $validated['access_rights'],
            'is_active' => $request->has('is_active'),
            'email_verified' => $request->has('email_verified') ? 1 : 0,
        ];

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $userData['profile_image'] = $this->fileUploadService->upload(
                $request->file('profile_image'),
                'profiles'
            );
        }

        User::create($userData);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'first_name' => 'required|string|max:255',
            'midle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'access_rights' => 'required|in:Admin,Student,Teacher,Staff',
            'is_active' => 'boolean',
            'profile_image' => ['nullable', ...FileUploadService::getImageRules()],
        ]);

        $updateData = [
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'first_name' => $validated['first_name'],
            'midle_name' => $validated['midle_name'] ?? '',
            'middle_name' => $validated['midle_name'] ?? '',
            'last_name' => $validated['last_name'],
            'access_rights' => $validated['access_rights'],
            'is_active' => $request->has('is_active'),
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $updateData['profile_image'] = $this->fileUploadService->upload(
                $request->file('profile_image'),
                'profiles',
                $user->profile_image
            );
        }

        // Handle email verification
        $updateData['email_verified'] = $request->has('email_verified') ? 1 : 0;

        $user->update($updateData);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}