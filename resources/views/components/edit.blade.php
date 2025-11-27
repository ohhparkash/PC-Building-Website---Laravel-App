@extends('layouts.site')

@section('title', 'Edit Component')

@section('content')
<section class="py-5" style="background:#0f0f0f;">
    <div class="container">
        <div class="mb-4">
            <p class="text-uppercase text-white-50 small mb-1">Inventory · Admin</p>
            <h1 class="text-white mb-0">Edit Component</h1>
            <p class="text-white-50 mb-0">{{ $component->name }}</p>
        </div>
        <div class="card border-0 shadow" style="background:#1a1a1a;">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>We ran into {{ $errors->count() }} issue(s):</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.components.update', $component) }}">
                    @method('PUT')
                    @php($submitLabel = 'Update Component')
                    @include('components.form')
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

