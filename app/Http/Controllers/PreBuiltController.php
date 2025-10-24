<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreBuiltController extends Controller
{
    /**
     * Get all pre-built PC configurations
     */
    public static function getPreBuiltPCs()
    {
        return [
            'budget-gaming' => [
                'name' => 'Budget Gaming PC',
                'description' => 'Perfect for 1080p gaming at 60+ FPS and everyday tasks',
                'price' => 165000,
                'image' => '/images/computers/budget_gaming_pc.png',
                'components' => [
                    'CPU' => ['name' => 'Intel Core i5-12400F', 'price' => 38000, 'img' => '/images/components/intel-core-i5-12400f.jpg'],
                    'Motherboard' => ['name' => 'MSI B550 Tomahawk', 'price' => 28000, 'img' => '/images/components/MSI-MAG-B550-TOMAHAWK-AM4-ATX.jpg'],
                    'Memory' => ['name' => 'Corsair Vengeance 16GB DDR4', 'price' => 14000, 'img' => '/images/components/VENG_LPX_BLK_01.avif'],
                    'Storage' => ['name' => 'WD Blue SN570 1TB', 'price' => 12000, 'img' => '/images/components/WD Blue SN570 1TB.jpg'],
                    'GPU' => ['name' => 'NVIDIA RTX 3060 12GB', 'price' => 55000, 'img' => '/images/components/NVIDIA GeForce RTX 3060.jpg'],
                    'PSU' => ['name' => 'Corsair RM650 650W Gold', 'price' => 15000, 'img' => '/images/components/Corsair RM650.avif'],
                    'Case' => ['name' => 'NZXT H510 Mid Tower', 'price' => 12000, 'img' => '/images/components/NZXT H510.jpg'],
                ],
            ],
            'high-end-gaming' => [
                'name' => 'High-End Gaming PC',
                'description' => 'Extreme performance for 4K gaming, VR, and streaming at maximum settings',
                'price' => 387000,
                'image' => '/images/computers/highend_gaming_pc.png',
                'components' => [
                    'CPU' => ['name' => 'AMD Ryzen 7 5800X', 'price' => 68000, 'img' => '/images/components/amd-ryzen-7-5800x.avif'],
                    'Motherboard' => ['name' => 'ASUS TUF Gaming Z690', 'price' => 65000, 'img' => '/images/components/ASUS TUF Gaming Z690-Plus.png'],
                    'Memory' => ['name' => 'G.Skill Trident Z 32GB DDR4', 'price' => 45000, 'img' => '/images/components/g.skill_trident_z.jpg'],
                    'Storage' => ['name' => 'Samsung 970 EVO Plus 1TB', 'price' => 28000, 'img' => '/images/components/Samsung 970 EVO Plus 1TB.jpg'],
                    'GPU' => ['name' => 'AMD RX 6700 XT 12GB', 'price' => 145000, 'img' => '/images/components/AMD Radeon RX 6700 XT.jpg'],
                    'PSU' => ['name' => 'Seasonic Focus GX-750', 'price' => 38000, 'img' => '/images/components/Seasonic Focus GX-750.jpg'],
                    'Case' => ['name' => 'Fractal Design Meshify C', 'price' => 28000, 'img' => '/images/components/Fractal Design Meshify C.jpg'],
                ],
            ],
            'workstation' => [
                'name' => 'Professional Workstation',
                'description' => 'Optimized for video editing, 3D rendering, CAD, and heavy multitasking',
                'price' => 315000,
                'image' => '/images/computers/professional_workstation_pc.png',
                'components' => [
                    'CPU' => ['name' => 'AMD Ryzen 7 5800X', 'price' => 68000, 'img' => '/images/components/amd-ryzen-7-5800x.avif'],
                    'Motherboard' => ['name' => 'ASUS TUF Gaming Z690', 'price' => 62000, 'img' => '/images/components/ASUS TUF Gaming Z690-Plus.png'],
                    'Memory' => ['name' => 'G.Skill Trident Z 32GB DDR4', 'price' => 48000, 'img' => '/images/components/g.skill_trident_z.jpg'],
                    'Storage' => ['name' => 'Samsung 970 EVO Plus 1TB', 'price' => 28000, 'img' => '/images/components/Samsung 970 EVO Plus 1TB.jpg'],
                    'GPU' => ['name' => 'AMD RX 6700 XT 12GB', 'price' => 85000, 'img' => '/images/components/AMD Radeon RX 6700 XT.jpg'],
                    'PSU' => ['name' => 'Seasonic Focus GX-750', 'price' => 38000, 'img' => '/images/components/Seasonic Focus GX-750.jpg'],
                    'Case' => ['name' => 'Fractal Design Meshify C', 'price' => 26000, 'img' => '/images/components/Fractal Design Meshify C.jpg'],
                ],
            ],
        ];
    }

    /**
     * Display pre-built rigs listing
     */
    public function index()
    {
        $preBuiltPCs = self::getPreBuiltPCs();
        return view('prebuilt', compact('preBuiltPCs'));
    }

    /**
     * Show details of a specific pre-built PC
     */
    public function show($id)
    {
        $preBuiltPCs = self::getPreBuiltPCs();
        
        if (!isset($preBuiltPCs[$id])) {
            return redirect()->route('prebuilt')->with('error', 'PC configuration not found');
        }

        $pc = $preBuiltPCs[$id];
        $pc['id'] = $id;
        
        return view('prebuilt-detail', compact('pc'));
    }

    /**
     * Add pre-built PC to cart
     */
    public function addToCart($id)
    {
        $preBuiltPCs = self::getPreBuiltPCs();
        
        if (!isset($preBuiltPCs[$id])) {
            return redirect()->route('prebuilt')->with('error', 'PC configuration not found');
        }

        $pc = $preBuiltPCs[$id];
        
        // Create cart with all components
        $cart = [];
        foreach ($pc['components'] as $category => $component) {
            $cart[$category] = [
                'category' => $category,
                'name' => $component['name'],
                'price' => '₨' . number_format($component['price']),
            ];
        }

        // Save to session
        session(['cart' => $cart]);
        session(['prebuilt_name' => $pc['name']]);

        return redirect()->route('checkout')->with('success', 'Pre-built PC added to cart!');
    }
}

