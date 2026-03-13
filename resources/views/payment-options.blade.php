@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ route('subscription') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Plans
            </a>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Choose Payment Method</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Complete your {{ $planDetails['name'] }} subscription by selecting your preferred payment method.
            </p>
        </div>

        <!-- Plan Summary Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $planDetails['name'] }} Plan</h2>
                    <p class="text-gray-600">Monthly subscription</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-gray-900">${{ $planDetails['price'] }}</div>
                    <p class="text-gray-600">/month</p>
                </div>
            </div>
        </div>

        <!-- Payment Options -->
        <form action="{{ route('subscription.process', $plan) }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Credit Card Option -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-transparent hover:border-green-500 transition-colors duration-200 cursor-pointer">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" value="credit-card" class="w-4 h-4 text-green-600 focus:ring-green-500" required>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center">
                            <div class="w-12 h-8 bg-gradient-to-r from-blue-600 to-blue-400 rounded flex items-center justify-center mr-3">
                                <svg class="w-6 h-4 text-white" fill="currentColor" viewBox="0 0 24 16">
                                    <rect x="1" y="4" width="22" height="8" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                                    <rect x="3" y="6" width="6" height="4" fill="currentColor"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Credit Card</h3>
                                <p class="text-gray-600">Visa, Mastercard, American Express</p>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-500">
                            Secure payment powered by Stripe. Instant activation.
                        </div>
                    </div>
                </label>
            </div>

            <!-- PayPal Option -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-transparent hover:border-green-500 transition-colors duration-200 cursor-pointer">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" value="paypal" class="w-4 h-4 text-green-600 focus:ring-green-500" required>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center">
                            <div class="w-12 h-8 bg-blue-700 rounded flex items-center justify-center mr-3">
                                <span class="text-white font-bold text-sm">P</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">PayPal</h3>
                                <p class="text-gray-600">Pay with your PayPal account</p>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-500">
                            Fast, secure checkout with buyer protection.
                        </div>
                    </div>
                </label>
            </div>

            <!-- Bank Transfer Option -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-transparent hover:border-green-500 transition-colors duration-200 cursor-pointer">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" value="bank-transfer" class="w-4 h-4 text-green-600 focus:ring-green-500" required>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center">
                            <div class="w-12 h-8 bg-gray-700 rounded flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Bank Transfer</h3>
                                <p class="text-gray-600">Direct bank deposit or wire transfer</p>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-500">
                            For annual subscriptions. 1-2 business days processing time.
                        </div>
                    </div>
                </label>
            </div>

            <!-- Features Included -->
            <div class="bg-green-50 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">What's included in {{ $planDetails['name'] }}:</h3>
                <ul class="space-y-2">
                    @foreach($planDetails['features'] as $feature)
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 bg-green-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition-colors duration-200">
                    Complete Subscription - ${{ $planDetails['price'] }}/month
                </button>
                <a href="{{ route('subscription') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Security Badge -->
        <div class="mt-8 text-center">
            <div class="inline-flex items-center text-gray-600">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm">Secure 256-bit SSL encryption. Your payment information is safe and protected.</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentOptions = document.querySelectorAll('input[name="payment_method"]');
    const optionCards = document.querySelectorAll('.bg-white.rounded-2xl.shadow-lg.p-6');
    
    paymentOptions.forEach(option => {
        option.addEventListener('change', function() {
            // Remove border from all cards
            optionCards.forEach(card => {
                card.classList.remove('border-green-500');
                card.classList.add('border-transparent');
            });
            
            // Add border to selected card
            if (this.checked) {
                this.closest('.bg-white.rounded-2xl.shadow-lg.p-6').classList.remove('border-transparent');
                this.closest('.bg-white.rounded-2xl.shadow-lg.p-6').classList.add('border-green-500');
            }
        });
    });
});
</script>
@endsection
