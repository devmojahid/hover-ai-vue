<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stripe\Stripe;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stripe::setApiKey(config('stripe.stripe_api.secret'));
        $plans = [
            [
                'name' => 'Basic',
                'stripe_plan_id' => 'basic',
                'stripe_product_id' => 'product_basic',
                'stripe_price' => 9.99,
                'interval' => 'month',
                'interval_count' => 1,
                'trial_period_days' => 7,
                'credits' => 100,
            ],
            [
                'name' => 'Pro',
                'stripe_plan_id' => 'pro',
                'stripe_product_id' => 'product_pro',
                'stripe_price' => 19.99,
                'interval' => 'month',
                'interval_count' => 1,
                'trial_period_days' => 14,
                'credits' => 200,
            ],
            [
                'name' => 'Premium',
                'stripe_plan_id' => 'premium',
                'stripe_product_id' => 'product_premium',
                'stripe_price' => 29.99,
                'interval' => 'month',
                'interval_count' => 1,
                'trial_period_days' => 30,
                'credits' => 300,
            ],
        
        ];
        
        foreach ($plans as $plan) {
            try {
                $stripePlanId = \Stripe\Plan::retrieve(strtolower($plan['stripe_plan_id']));
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                try {
                    $stripeProduct = \Stripe\Product::retrieve($plan['stripe_product_id']);
                } catch (\Stripe\Exception\InvalidRequestException $e) {

                    //if the stripe product exists then update it
                    if($stripeProduct = \Stripe\Product::retrieve($plan['stripe_product_id'])){
                        $stripeProduct = \Stripe\Product::update($plan['stripe_product_id'], [
                            'name' => $plan['name'],
                        ]);
                    }
                    else{
                    $stripeProduct = \Stripe\Product::create([
                        'name' => $plan['name'],
                        'id' => $plan['stripe_product_id'],
                    ]);
                }
                }

                //if the plan exists then update it
                if($stripePlanId = Plan::where('stripe_plan_id', $plan['stripe_plan_id'])->first()){
                    $stripePlan = \Stripe\Plan::update($stripePlanId, [
                        'amount' => $plan['stripe_price'] * 100,
                        'currency' => 'usd',
                        'interval' => $plan['interval'],
                        'interval_count' => $plan['interval_count'],
                        'product' => $plan['stripe_product_id'],
                        'nickname' => $plan['name'],
                        'trial_period_days' => $plan['trial_period_days'],
                    ]);
                    $stripePlanId = $stripePlan->id;
                }
                else{
                    $stripePlan = \Stripe\Plan::create([
                        'amount' => $plan['stripe_price'] * 100,
                        'currency' => 'usd',
                        'interval' => $plan['interval'],
                        'interval_count' => $plan['interval_count'],
                        'product' => $plan['stripe_product_id'],
                        'nickname' => $plan['name'],
                        'trial_period_days' => $plan['trial_period_days'],
                    ]);
                    $stripePlanId = $stripePlan->id;
                }
            }
        
            Plan::updateOrCreate(['stripe_plan_id' => $stripePlanId], [
                'name' => $plan['name'],
                'stripe_plan_id' => $stripePlanId,
                'stripe_product_id' => $plan['stripe_product_id'],
                'stripe_price' => $plan['stripe_price'],
                'interval' => $plan['interval'],
                'interval_count' => $plan['interval_count'],
                'trial_period_days' => $plan['trial_period_days'],
                'credits' => $plan['credits'],
            ]);
        }
        
    }
}