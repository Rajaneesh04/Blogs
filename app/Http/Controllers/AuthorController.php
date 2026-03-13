<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index()
    {
        $blogs = Auth::user()->blogs()->latest()->paginate(10);
        return view('author.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('author.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->short_desc = $request->short_desc;
        $blog->body = $request->body;
        $blog->category_id = $request->category_id;
        $blog->user_id = Auth::id();
        $blog->likes = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('blogs','public');
            $blog->image = $image;
        }

        $blog->save();

        return redirect()->route('author.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function edit(Blog $blog)
    {
        if ($blog->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('author.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        if ($blog->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog->title = $request->title;
        $blog->short_desc = $request->short_desc;
        $blog->body = $request->body;
        $blog->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('blogs','public');
            $blog->image = $image;
        }

        $blog->save();

        return redirect()->route('author.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $blog->delete();

        return redirect()->route('author.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
