<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\StripeClient;
use Illuminate\Support\Str;
use Stripe\Stripe;

use Stripe\PaymentIntent;
use Stripe\Exception\CardException;

class SubscriptionController extends Controller
{
    public function plans()
    {
        $plans = \App\Models\Plan::all();
        return Inertia::render('Plans', [
            'plans' => $plans,
        ]);
    }

    public function subscribe($productId)
    {
        $product = \App\Models\Plan::where('stripe_product_id', $productId)->first();
        return Inertia::render('Subscribe', [
            'product' => $product,
            'intent' => auth()->user()->createSetupIntent()
        ]);
        // $plan = \App\Models\Plan::findOrFail($request->plan);
        // $user = $request->user();
        // $user->newSubscription('default', $plan->stripe_id)->create($request->token);
        // return redirect()->route('dashboard');
    }

    public function processPayment(Request $request)
    {
        try {
        Stripe::setApiKey(config("stripe.stripe_api.secret"));
        $paymentIntent = PaymentIntent::create([
            'amount' => 1000,
            'currency' => 'usd',
            'payment_method' => $request->payment_method,
            'off_session' => true,
            'confirm' => true,
        ]);
        return response()->json(['success' => 'PaymentIntent processed']);
        } catch (CardException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        
    }

    public function createPaymentIntent(Request $request)
    {
        // $user = $request->user();
        // $product = \App\Models\Plan::where('stripe_product_id', $request->product)->first();
        // $stripe = new Stripe

        // $paymentIntent = $stripe->paymentIntents->create([
        //     'amount' => $product->price * 100,
        //     'currency' => 'usd',
        //     'customer' => $user->stripe_id,
        //     'payment_method' => $request->payment_method,
        //     'off_session' => true,
        //     'confirm' => true,
        // ]);

        Stripe::setApiKey(config("stripe.stripe_api.secret"));
        try {
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => "1000",
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        return[
            'token' => (string) Str::uuid(),
            'client_secret' => $paymentIntent->client_secret
        ];

        // $user = $request->user();
        // $product = \App\Models\Plan::where('stripe_product_id', $request->product)->first();
        // $paymentIntent = $user->createSetupIntent();
        // return response()->json(['client_secret' => $paymentIntent->client_secret]);
    }


    //checkout
    public function checkout(Request $request){
        dd($request->all());
    }
}