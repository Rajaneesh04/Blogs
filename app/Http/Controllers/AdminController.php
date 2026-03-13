<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\ContactSubmission;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function logout(Request $req)
    {
        $req->session()->forget('admin');
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $blogs = Blog::latest()->take(5)->get();
        $contactSubmissions = ContactSubmission::latest()->take(5)->get();

        return view('admin.dashboard', [
            'blogs' => $blogs,
            'contactSubmissions' => $contactSubmissions,
            'totalBlogs' => Blog::count(),
            'registeredUsers' => User::count(),
            'totalContactMessages' => ContactSubmission::count(),
        ]);
    }

    public function checkLogin(Request $req)
    {
        if($req->username == 'admin' && $req->password == '1234'){
        session()->put('admin',true);
        return redirect()->route('admin.dashboard');
    }
    return back()->with('error','Invalid Login');
    }

    public function index()
    {
        $blogs = Blog::with('category')->get();
        return view('admin.blogs.index', compact('blogs'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function contactReq()
    {
        $contactSubmissions = ContactSubmission::latest()->take(10)->get();

        return view('admin.contactreq', compact('contactSubmissions'));
    }

    public function store(Request $req)
    {
        $image=$req->file('image')->store('blogs','public');

        Blog::create([
            'title' => $req->title,
            'short_desc' => $req->short_desc,
            'image' => $image,
            'body' => $req->body,
            'category_id' => $req->category_id,
            ]);
        return redirect()->route('admin.blogs.index');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $req, Blog $blog)
    {
        $data = $req->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($req->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $data['image'] = $req->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index');
    }

    // User Management Methods
    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function toggleUserActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'User status updated successfully.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    // Contact Requests Management
    public function contactRequests()
    {
        $contactSubmissions = ContactSubmission::latest()->get();
        return view('admin.contact-requests.index', compact('contactSubmissions'));
    }

    public function deleteContactRequest(ContactSubmission $submission)
    {
        $submission->delete();
        return redirect()->route('admin.contactreq.index')->with('success', 'Contact request deleted successfully.');
    }
}
