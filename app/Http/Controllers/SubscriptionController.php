<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\StripeClient;

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
}