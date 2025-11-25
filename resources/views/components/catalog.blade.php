@extends('layouts.app')

@section('title', 'Component Catalog')

@section('content')
<section class="py-5" style="background:#0c0c0c; min-height: calc(100vh - 150px);">
    <div class="container">
        <div class="mb-4">
            <p class="text-uppercase text-white-50 small mb-1">Live Inventory</p>
            <h1 class="text-white mb-0">Component Catalog</h1>
            <p class="text-white-50 mb-0">Every component shown here is managed through the admin module.</p>
        </div>

        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label text-white-50 small">Category</label>
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" @if(($filters['category'] ?? '') === $category) selected @endif>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label text-white-50 small">Search</label>
                <input type="text" name="search" class="form-control" placeholder="Search by name or brand" value="{{ $filters['search'] ?? '' }}">
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button class="btn btn-warning w-100 text-dark" type="submit">Filter</button>
                @if(!empty(array_filter($filters)))
                    <a href="{{ route('components.catalog') }}" class="btn btn-outline-light w-100">Reset</a>
                @endif
            </div>
        </form>

        @if($components->isEmpty())
            <div class="text-center text-white-50 py-5">
                <p class="mb-0">No components match the selected filters yet.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($components as $component)
                    <div class="col-md-4">
                        <div class="card h-100" style="background:#161616; border: 1px solid #2a2a2a;">
                            @if($component->image_url)
                                <img src="{{ $component->image_url }}" alt="{{ $component->name }}" class="card-img-top" style="height:200px; object-fit:cover;">
                            @endif
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-warning text-dark">{{ $component->category }}</span>
                                    @if($component->is_featured)
                                        <span class="badge bg-success">Featured</span>
                                    @endif
                                </div>
                                <h5 class="card-title">{{ $component->name }}</h5>
                                <p class="text-white-50 small mb-2">{{ $component->brand ?? 'Unbranded' }}</p>
                                <p class="text-white-50 small">{{ \Illuminate\Support\Str::limit($component->short_description ?? 'Detailed specs available in store.', 120) }}</p>
                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <p class="fw-bold mb-0">PKR {{ number_format($component->price, 0) }}</p>
                                        <small class="text-white-50">Stock: {{ $component->stock }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $components->links() }}
            </div>
        @endif
    </div>
</section>
@endsection

