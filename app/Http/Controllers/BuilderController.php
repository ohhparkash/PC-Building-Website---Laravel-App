<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuilderController extends Controller
{
    /**
     * Display the PC builder page
     */
    public function index()
    {
        // Component data (same as your $components array)
        $components = [
            'CPU' => [
                ['name' => 'AMD Ryzen 5 5600X', 'price' => '₨42,000', 'img' => '/images/components/amd-ryzen-5-5600x.avif'],
                ['name' => 'AMD Ryzen 7 5800X', 'price' => '₨55,000', 'img' => '/images/components/amd-ryzen-7-5800x.avif'],
                ['name' => 'Intel Core i5-12400F', 'price' => '₨48,000', 'img' => '/images/components/intel-core-i5-12400f.jpg'],
            ],
            'Motherboard' => [
                ['name' => 'MSI B550 Tomahawk', 'price' => '₨35,000', 'img' => '/images/components/MSI-MAG-B550-TOMAHAWK-AM4-ATX.jpg'],
                ['name' => 'ASUS TUF Gaming Z690', 'price' => '₨52,000', 'img' => '/images/components/ASUS TUF Gaming Z690-Plus.png'],
            ],
            'Memory' => [
                ['name' => 'Corsair Vengeance 16GB DDR4', 'price' => '₨18,000', 'img' => '/images/components/VENG_LPX_BLK_01.avif'],
                ['name' => 'G.Skill Trident Z 32GB DDR4', 'price' => '₨32,000', 'img' => '/images/components/g.skill_trident_z.jpg'],
            ],
            'Storage' => [
                ['name' => 'Samsung 970 EVO Plus 1TB', 'price' => '₨15,000', 'img' => '/images/components/Samsung 970 EVO Plus 1TB.jpg'],
                ['name' => 'WD Blue SN570 1TB', 'price' => '₨22,000', 'img' => '/images/components/WD Blue SN570 1TB.jpg'],
            ],
            'GPU' => [
                ['name' => 'NVIDIA RTX 3060 12GB', 'price' => '₨85,000', 'img' => '/images/components/NVIDIA GeForce RTX 3060.jpg'],
                ['name' => 'AMD RX 6700 XT 12GB', 'price' => '₨95,000', 'img' => '/images/components/AMD Radeon RX 6700 XT.jpg'],
            ],
            'PSU' => [
                ['name' => 'Corsair RM650 650W Gold', 'price' => '₨28,000', 'img' => '/images/components/Corsair RM650.avif'],
                ['name' => 'Seasonic Focus GX-750', 'price' => '₨35,000', 'img' => '/images/components/Seasonic Focus GX-750.jpg'],
            ],
            'Case' => [
                ['name' => 'NZXT H510 Mid Tower', 'price' => '₨22,000', 'img' => '/images/components/NZXT H510.jpg'],
                ['name' => 'Fractal Design Meshify C', 'price' => '₨25,000', 'img' => '/images/components/Fractal Design Meshify C.jpg'],
            ],
        ];

        // Get cart from session
        $cart = session('cart', []);

        // Calculate required categories
        $requiredCategories = ['CPU', 'Motherboard', 'Memory', 'Storage', 'GPU', 'PSU', 'Case'];
        $missingComponents = array_diff($requiredCategories, array_keys($cart));
        $allComponentsSelected = empty($missingComponents);

        // Pass data to view
        return view('builder', compact('components', 'cart', 'allComponentsSelected', 'missingComponents'));
    }
}