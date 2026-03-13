<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\ContactSubmission;
use App\Models\Category;

class BlogController extends Controller
{
    public function home()
    {
        return view ('home');
    }

    public function about()
    {
        return view('about');
    }

    public function blogs()
    {
       $blogs = Blog::with(['category', 'user'])->latest()->get();
       $categories = Category::all();
       $likedBlogIds = collect(session('liked_blogs', []))
            ->map(fn ($id) => (int) $id)
            ->all();

       return view('blogs', compact('blogs','categories', 'likedBlogIds'));
    }

    public function show($id)
    {
        $blog = Blog::with(['category', 'user'])->findOrfail($id);
        return view('single',compact('blog'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactSubmission::create($validated);

        return redirect()
            ->route('contact')
            ->with('success', 'Your message has been submitted successfully.');
    }
    
    public function filterByCategory($id)
    {
        $blogs = Blog::with('category')
        ->where('category_id', $id)
        ->latest()
        ->get();
        $likedBlogIds = collect(session('liked_blogs', []))
            ->map(fn ($id) => (int) $id)
            ->all();

        return view('partials.blog_cards', compact('blogs', 'likedBlogIds'))->render();
    }

    public function filterBlogs(Request $request)
    {
        $categoryId = $request->query('category');
        $title = trim((string) $request->query('title', ''));

        $query = Blog::with('category')->latest();

        if (!empty($categoryId) && $categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }

        if ($title !== '') {
            $query->where('title', 'like', '%' . $title . '%');
        }

        $blogs = $query->get();

        $likedBlogIds = collect(session('liked_blogs', []))
            ->map(fn ($id) => (int) $id)
            ->all();

        return view('partials.blog_cards', compact('blogs', 'likedBlogIds'))->render();
    }

    public function toggleLike(Request $request, Blog $blog)
    {
        $likedBlogs = collect($request->session()->get('liked_blogs', []))
            ->map(fn ($id) => (int) $id)
            ->all();

        if (in_array($blog->id, $likedBlogs, true)) {
            if (($blog->likes ?? 0) > 0) {
                $blog->decrement('likes');
            }
            $likedBlogs = array_values(array_filter($likedBlogs, fn ($id) => $id !== $blog->id));
        } else {
            $blog->increment('likes');
            $likedBlogs[] = $blog->id;
        }

        $request->session()->put('liked_blogs', array_values(array_unique($likedBlogs)));

        return back();
    }

    public function subscription()
    {
        return view('subscription');
    }

    public function paymentOptions($plan)
    {
        $validPlans = ['pro', 'pro-max'];
        if (!in_array($plan, $validPlans)) {
            return redirect()->route('subscription')->with('error', 'Invalid plan for payment options.');
        }

        $planDetails = [
            'pro' => [
                'name' => 'Pro',
                'price' => 19,
                'features' => ['Unlimited blog post access', 'Exclusive content', 'Priority support', 'Download offline reading']
            ],
            'pro-max' => [
                'name' => 'Pro Max',
                'price' => 49,
                'features' => ['Everything in Pro', 'Early access to new features', '24/7 phone support', 'Custom content requests', 'Team collaboration tools']
            ]
        ];

        return view('payment-options', [
            'plan' => $plan,
            'planDetails' => $planDetails[$plan]
        ]);
    }

    public function processSubscription(Request $request, $plan)
    {
        // Validate the plan
        $validPlans = ['free', 'pro', 'pro-max'];
        if (!in_array($plan, $validPlans)) {
            return redirect()->route('subscription')->with('error', 'Invalid subscription plan selected.');
        }

        // Validate payment method for paid plans
        if ($plan !== 'free') {
            $request->validate([
                'payment_method' => 'required|string|in:credit-card,paypal,bank-transfer'
            ]);
        }

        // Store subscription info in session (in a real app, this would be saved to database)
        $subscriptionData = [
            'plan' => $plan,
            'plan_name' => ucfirst(str_replace('-', ' ', $plan)),
            'price' => $plan === 'free' ? 0 : ($plan === 'pro' ? 19 : 49),
            'payment_method' => $plan === 'free' ? 'none' : $request->payment_method,
            'subscribed_at' => now(),
        ];

        session(['subscription' => $subscriptionData]);

        // Redirect to thank you page
        return redirect()->route('subscription.thank-you')->with('success', 'Subscription successful!');
    }

    public function subscriptionThankYou()
    {
        $subscription = session('subscription');
        
        if (!$subscription) {
            return redirect()->route('subscription');
        }

        return view('subscription-thank-you', compact('subscription'));
    }
}
