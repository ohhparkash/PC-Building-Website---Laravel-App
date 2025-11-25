@csrf

<div class="row g-4">
    <div class="col-md-6">
        <label class="form-label text-white">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $component->name ?? '') }}" required>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label text-white">Category</label>
        <input type="text" name="category" class="form-control" value="{{ old('category', $component->category ?? '') }}" required>
        @error('category') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label text-white">Brand</label>
        <input type="text" name="brand" class="form-control" value="{{ old('brand', $component->brand ?? '') }}">
        @error('brand') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label text-white">Price (PKR)</label>
        <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price', $component->price ?? 0) }}" required>
        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label text-white">Stock</label>
        <input type="number" min="0" name="stock" class="form-control" value="{{ old('stock', $component->stock ?? 0) }}" required>
        @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-12">
        <label class="form-label text-white">Image URL</label>
        <input type="url" name="image_url" class="form-control" value="{{ old('image_url', $component->image_url ?? '') }}">
        @error('image_url') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-12">
        <label class="form-label text-white">Short Description</label>
        <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $component->short_description ?? '') }}</textarea>
        @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-12">
        <label class="form-label text-white">Detailed Specs</label>
        <textarea name="specs" class="form-control" rows="5">{{ old('specs', $component->specs ?? '') }}</textarea>
        @error('specs') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-12 form-check form-switch mt-3">
        <input type="hidden" name="is_featured" value="0">
        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $component->is_featured ?? false) ? 'checked' : '' }}>
        <label class="form-check-label text-white" for="is_featured">Mark as featured</label>
    </div>
</div>

<div class="mt-4 d-flex gap-3">
    <button type="submit" class="btn btn-warning text-dark fw-semibold">{{ $submitLabel }}</button>
    <a href="{{ route('admin.components.index') }}" class="btn btn-outline-light">Cancel</a>
</div>

