<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add component to cart
     */
    public function add(Request $request)
    {
        // Get current cart
        $cart = session('cart', []);

        // Create component array
        $component = [
            'category' => $request->input('category'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ];

        // Add to cart (using category as key to prevent duplicates)
        $cart[$component['category']] = $component;

        // Save cart to session
        session(['cart' => $cart]);

        // Redirect back to builder
        return redirect()->route('builder');
    }

    /**
     * Remove component from cart
     */
    public function remove(Request $request)
    {
        $cart = session('cart', []);
        $category = $request->input('category');

        // Remove category from cart
        if (isset($cart[$category])) {
            unset($cart[$category]);
        }

        // Save updated cart
        session(['cart' => $cart]);

        return redirect()->route('builder');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        session()->forget('cart');
        session()->forget('order');
        
        return redirect()->route('builder');
    }

    /**
     * Reset cart and order (for home page)
     */
    public function reset()
    {
        session()->forget('cart');
        session()->forget('order');
        
        return redirect()->route('home');
    }

    /**
     * Calculate total price
     * This is a helper function you can call from views
     */
    public static function getTotal()
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $component) {
            // Remove ₨ and commas, then convert to float
            $price = str_replace(['₨', ','], '', $component['price']);
            $total += floatval($price);
        }

        return $total;
    }

    /**
     * Check if category is in cart
     */
    public static function inCart($category)
    {
        $cart = session('cart', []);
        return isset($cart[$category]);
    }
}