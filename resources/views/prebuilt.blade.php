@extends('layouts.site')

@section('title', 'Pre-Built PCs')

@section('content')
<div class="container my-4">
    <h2 class="text-white mb-2">Pre-Built Gaming PCs</h2>
    <p class="text-muted mb-4">Choose from our carefully crafted PC configurations</p>

    <div class="row">
        @foreach($preBuiltPCs as $id => $pc)
        <div class="col-md-4 mb-4">
            <a href="{{ route('prebuilt.show', $id) }}" class="text-decoration-none">
                <div class="card h-100 prebuilt-card">
                    <div class="card-body d-flex flex-column">
                        <div class="text-center mb-3">
                            <img src="{{ asset($pc['image']) }}" alt="{{ $pc['name'] }}" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                        </div>
                        
                        <h4 class="card-title text-white mb-2">{{ $pc['name'] }}</h4>
                        <p class="text-muted small mb-3">{{ $pc['description'] }}</p>
                        
                        <div class="mb-3">
                            <h5 class="text-warning mb-2">Includes:</h5>
                            <ul class="small text-muted list-unstyled">
                                @foreach($pc['components'] as $category => $component)
                                    <li class="mb-1">
                                        <span class="text-white-50">{{ $category }}:</span> {{ $component['name'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="mt-auto">
                            <hr class="border-secondary">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-white fw-bold">Total Price:</span>
                                <span class="text-warning fw-bold fs-5">₨{{ number_format($pc['price']) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        <p class="text-muted">Want to build your own? <a href="{{ route('builder') }}" class="text-warning">Use our PC Builder</a></p>
    </div>
</div>
@endsection

