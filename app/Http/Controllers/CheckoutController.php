<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function index()
    {
        // Check if cart has all 7 components
        $cart = session('cart', []);
        
        if (count($cart) < 7) {
            return redirect()->route('builder')->with('error', 'Please select all 7 components');
        }

        return view('checkout', compact('cart'));
    }

    /**
     * Process checkout form
     */
    public function process(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email',
            'phone.required' => 'Phone number is required',
            'address.required' => 'Address is required',
        ]);

        // Create order
        $order = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'date' => now()->format('Y-m-d H:i:s'),
            'order_id' => 'AB' . now()->format('Ymd') . rand(1000, 9999),
        ];

        // Clear the cart after order
        session()->forget('cart');

        // Redirect to home with success message
        return redirect()->route('home')->with('success', 'Order Placed Successfully!');
    }
}