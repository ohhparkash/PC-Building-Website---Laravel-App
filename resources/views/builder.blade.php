@extends('layouts.app')

@section('title', 'PC Builder')

@section('content')
<div class="container my-4">
    <h2 class="text-white">Build Your PC</h2>
    <p class="text-muted">Select components for your custom PC build</p>

    <div class="row">
        <div class="col-md-8">
            @foreach($components as $category => $items)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>{{ $category }}</strong>
                    @if(in_array($category, array_keys($cart)))
                        <span class="badge bg-success float-end">Selected</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($items as $item)
                        <div class="col-md-6 mb-3">
                            <div class="component-card">
                                <img src="{{ asset($item['img']) }}" alt="{{ $item['name'] }}" onerror="this.src='/images/components/placeholder.jpg'">
                                <h6>{{ $item['name'] }}</h6>
                                <div class="text-warning mb-2">{{ $item['price'] }}</div>
                                
                                @if(isset($cart[$category]))
                                    <form method="POST" action="{{ route('cart.remove') }}">
                                        @csrf
                                        <input type="hidden" name="category" value="{{ $category }}">
                                        <button type="submit" class="btn btn-sm btn-danger w-100">Remove</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="category" value="{{ $category }}">
                                        <input type="hidden" name="name" value="{{ $item['name'] }}">
                                        <input type="hidden" name="price" value="{{ $item['price'] }}">
                                        <button type="submit" class="btn btn-sm btn-primary w-100">Add to Build</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <strong>Your Build Summary</strong>
                </div>
                <div class="card-body">
                    @if(empty($cart))
                        <p class="text-muted">No components selected yet</p>
                        <small class="text-muted">Select 7 components to complete your build</small>
                    @else
                        @foreach($cart as $category => $item)
                        <div class="mb-3 pb-2 border-bottom">
                            <div class="text-warning small">{{ $category }}</div>
                            <div class="fw-bold">{{ $item['name'] }}</div>
                            <div class="text-muted small">{{ $item['price'] }}</div>
                        </div>
                        @endforeach

                        <div class="mb-3">
                            <small class="text-muted">Components: {{ count($cart) }}/7</small>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong class="text-warning">₨{{ number_format(App\Http\Controllers\CartController::getTotal()) }}</strong>
                        </div>

                        @if($allComponentsSelected)
                            <a href="{{ route('checkout') }}" class="btn btn-success w-100">Proceed to Checkout</a>
                        @else
                            <button class="btn btn-secondary w-100" disabled>Select All Components</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
