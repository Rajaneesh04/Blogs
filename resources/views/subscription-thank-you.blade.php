@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Success Message -->
        <div class="text-center mb-12">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Thank You for Subscribing!</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Welcome to {{ $subscription['plan_name'] }}! Your subscription is now active.
            </p>
        </div>

        <!-- Subscription Details Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Subscription Details</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Plan</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $subscription['plan_name'] }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Monthly Price</h3>
                    <p class="text-lg font-semibold text-gray-900">
                        @if($subscription['price'] === 0)
                            Free
                        @else
                            ${{ $subscription['price'] }}/month
                        @endif
                    </p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Subscription Date</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($subscription['subscribed_at'])->format('F j, Y') }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Status</h3>
                    <p class="text-lg font-semibold text-green-600">Active</p>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">What's Next?</h2>
            
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-100">
                            <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Check your email</h3>
                        <p class="text-gray-600">We've sent a confirmation email with your subscription details and receipt.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-100">
                            <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Explore premium features</h3>
                        <p class="text-gray-600">Start enjoying all the benefits included in your {{ $subscription['plan_name'] }} plan.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-100">
                            <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Manage your subscription</h3>
                        <p class="text-gray-600">You can upgrade, downgrade, or cancel your subscription at any time from your account settings.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors duration-200">
                Start Exploring
            </a>
            
            <a href="{{ route('blogs') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                Browse Blogs
            </a>
        </div>

        <!-- Support Section -->
        <div class="mt-12 text-center">
            <p class="text-gray-600 mb-4">Have questions about your subscription?</p>
            <a href="{{ route('contact') }}" class="text-green-600 hover:text-green-700 font-medium">
                Contact Support →
            </a>
        </div>
    </div>
</div>
@endsection
