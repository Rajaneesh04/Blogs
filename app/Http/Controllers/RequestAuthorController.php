<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestAuthorController extends Controller
{
    /**
     * Show the request author page.
     */
    public function show()
    {
        $user = Auth::user();
        
        // If user is already author or admin, redirect to author blogs
        if ($user->canManageBlogs()) {
            return redirect()->route('author.blogs.index');
        }
        
        return view('author.request');
    }

    /**
     * Process the author request.
     */
    public function request(Request $request)
    {
        $user = Auth::user();
        
        // If user is already author or admin, redirect
        if ($user->canManageBlogs()) {
            return redirect()->route('author.blogs.index');
        }
        
        // Auto-promote user to author (you can change this to require admin approval)
        $user->role = User::ROLE_AUTHOR;
        $user->save();
        
        return redirect()->route('author.blogs.index')
            ->with('success', 'Congratulations! You are now an author and can create blogs.');
    }
}
