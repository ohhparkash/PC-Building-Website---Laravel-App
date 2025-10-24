@extends('layouts.app')

@section('title', $pc['name'])

@section('content')
<div class="container my-4">
    <div class="mb-4">
        <a href="{{ route('prebuilt') }}" class="text-warning text-decoration-none">
            <i class="bi bi-arrow-left"></i> Back to Pre-Built PCs
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="text-white mb-2">{{ $pc['name'] }}</h2>
                    <p class="text-muted mb-4">{{ $pc['description'] }}</p>
                    
                    <div class="text-center mb-4">
                        <img src="{{ asset($pc['image']) }}" alt="{{ $pc['name'] }}" class="img-fluid" style="max-height: 300px; object-fit: contain;">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong>Components Included</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($pc['components'] as $category => $component)
                        <div class="col-md-6 mb-3">
                            <div class="component-card">
                                <img src="{{ asset($component['img']) }}" alt="{{ $component['name'] }}" onerror="this.src='/images/components/placeholder.jpg'">
                                <div class="small text-warning mb-1">{{ $category }}</div>
                                <h6>{{ $component['name'] }}</h6>
                                <div class="text-white-50 small">₨{{ number_format($component['price']) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <strong>Build Summary</strong>
                </div>
                <div class="card-body">
                    <h5 class="text-white mb-3">{{ $pc['name'] }}</h5>
                    
                    <div class="mb-3">
                        <h6 class="text-warning small">Components:</h6>
                        @foreach($pc['components'] as $category => $component)
                        <div class="mb-2 pb-2 border-bottom">
                            <div class="small text-white-50">{{ $category }}</div>
                            <div class="small fw-bold">{{ $component['name'] }}</div>
                            <div class="small text-muted">₨{{ number_format($component['price']) }}</div>
                        </div>
                        @endforeach
                    </div>

                    <hr>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <strong class="text-white">Total Price:</strong>
                        <strong class="text-warning fs-5">₨{{ number_format($pc['price']) }}</strong>
                    </div>

                    <form method="POST" action="{{ route('prebuilt.addToCart', $pc['id']) }}">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 mb-2">Add to Cart</button>
                    </form>
                    
                    <a href="{{ route('prebuilt') }}" class="btn btn-secondary w-100">Browse More PCs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

