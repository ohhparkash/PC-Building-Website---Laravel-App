<?php
namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredComponents = Component::where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        if ($featuredComponents->isEmpty()) {
            $featuredComponents = Component::latest()->take(4)->get();
        }

        return view('home', compact('featuredComponents'));
    }
}