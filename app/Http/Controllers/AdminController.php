<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function dashboard(): Response
    {
        $stats = [
            'students' => User::where('role', 'student')->count(),
            'teachers' => User::where('role', 'teacher')->count(),
            'courses' => Course::count(),
            'categories' => Category::count(),
        ];

        $categories = Category::withCount('courses')->get();

        return response()->view('admin.dashboard', compact('stats', 'categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function users(): Response
    {
        $users = User::latest()->get();

        return response()->view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        $request->validate([
            'role' => 'required|in:admin,teacher,student',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', "User role updated to {$request->role} successfully!");
    }
}
