@extends('layouts.site')

@section('title', 'Home')

@section('content')
<section class="hero-section text-white py-5" style="min-height: 500px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-3 fw-bold mb-3" style="color: #d4af37;">AshBuilds</h1>
                <p class="lead mb-4">Your Ultimate Destination for Custom PC Builds in Pakistan</p>
                <p class="mb-4">Experience the power of choice. Build your dream PC with our carefully curated components, all at competitive prices.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('builder') }}" class="btn btn-lg px-5 py-3" style="background: #d4af37; color: #000; font-weight: 600;">Build Custom PC</a>
                    <a href="{{ route('prebuilt') }}" class="btn btn-lg btn-outline-warning px-5 py-3" style="font-weight: 600; border-color: #d4af37; color: #d4af37;">View Pre-Built PCs</a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/background/homepage_computer_image.png') }}" alt="Custom PC" class="img-fluid" style="max-height: 450px;">
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3" style="color: #d4af37;">Why AshBuilds?</h5>
                        <p class="card-text text-white-50">We offer a seamless experience for building custom PCs in Pakistan. Select from premium components, see real-time pricing in PKR, and get your dream machine delivered.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3" style="color: #d4af37;">Who is it for?</h5>
                        <p class="card-text text-white-50">Whether you're a gamer, content creator, or professional, our PC builder helps you choose the perfect components for your needs and budget.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3" style="color: #d4af37;">How to get started?</h5>
                        <p class="card-text text-white-50">Click "Start Building" above, select one component from each category, review your build, and checkout. It's that simple!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($featuredComponents) && $featuredComponents->isNotEmpty())
<section class="py-5" style="background: #0f0f0f;">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <p class="text-uppercase text-white-50 small mb-1">Inventory Spotlight</p>
                <h2 class="text-white mb-0">Featured Components</h2>
            </div>
            <a href="{{ route('components.catalog') }}" class="btn btn-outline-warning">View All Components</a>
        </div>
        <div class="row g-4">
            @foreach($featuredComponents as $component)
            <div class="col-md-6 col-xl-3">
                <div class="card h-100" style="background:#1a1a1a; border: 1px solid #333;">
                    @if($component->image_url)
                        <img src="{{ $component->image_url }}" class="card-img-top" alt="{{ $component->name }}" style="height:180px; object-fit:cover;">
                    @endif
                    <div class="card-body text-white">
                        <span class="badge bg-warning text-dark mb-2">{{ $component->category }}</span>
                        <h5 class="card-title">{{ $component->name }}</h5>
                        <p class="text-white-50 small mb-2">{{ \Illuminate\Support\Str::limit($component->short_description, 80) }}</p>
                        <p class="fw-bold mb-1">PKR {{ number_format($component->price, 0) }}</p>
                        <p class="text-white-50 small mb-0">In stock: {{ $component->stock }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection