@extends('layouts.site')

@section('title', 'Manage Components')

@section('content')
<section class="py-5" style="background:#0f0f0f; min-height: calc(100vh - 150px);">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-white-50 small mb-1">Inventory · Admin</p>
                <h1 class="text-white mb-0">Components</h1>
            </div>
            <a href="{{ route('admin.components.create') }}" class="btn btn-warning text-dark fw-semibold">Add Component</a>
        </div>

        <div class="card border-0 shadow" style="background:#1a1a1a;">
            <div class="card-body p-0">
                @if($components->isEmpty())
                    <div class="p-5 text-center text-white-50">
                        <p class="mb-0">No components found yet. Start by adding your first component.</p>
                    </div>
                @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price (PKR)</th>
                                <th>Stock</th>
                                <th>Featured</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($components as $component)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $component->name }}</div>
                                    <small class="text-white-50">{{ \Illuminate\Support\Str::limit($component->short_description, 60) }}</small>
                                </td>
                                <td>{{ $component->category }}</td>
                                <td>{{ $component->brand ?? '—' }}</td>
                                <td>{{ number_format($component->price, 0) }}</td>
                                <td>{{ $component->stock }}</td>
                                <td>
                                    @if($component->is_featured)
                                        <span class="badge bg-warning text-dark">Featured</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.components.edit', $component) }}" class="btn btn-sm btn-outline-light me-2">Edit</a>
                                    <form action="{{ route('admin.components.destroy', $component) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this component?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    {{ $components->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

