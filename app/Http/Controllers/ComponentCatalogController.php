<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentCatalogController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['category', 'search']);

        $componentsQuery = Component::query();

        if (!empty($filters['category'])) {
            $componentsQuery->where('category', $filters['category']);
        }

        if (!empty($filters['search'])) {
            $componentsQuery->where(function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('brand', 'like', '%' . $filters['search'] . '%');
            });
        }

        $components = $componentsQuery
            ->orderByDesc('is_featured')
            ->orderBy('name')
            ->paginate(9)
            ->withQueryString();

        $categories = Component::select('category')
            ->orderBy('category')
            ->distinct()
            ->pluck('category');

        return view('components.catalog', [
            'components' => $components,
            'categories' => $categories,
            'filters' => $filters,
        ]);
    }
}
