@extends('admin.layout')

@section('title', $product->exists ? 'Edit Product' : 'New Product')
@section('heading', $product->exists ? 'Edit Product' : 'New Product')

@section('content')
    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
          method="POST" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-3">
        @csrf
        @if ($product->exists) @method('PUT') @endif

        <div class="space-y-6 lg:col-span-2">
            <div class="card p-6">
                <h2 class="mb-4 font-display text-lg font-extrabold text-ink">Details</h2>
                <div class="grid gap-4">
                    <div>
                        <label class="form-label" for="name">Name *</label>
                        <input id="name" name="name" type="text" required value="{{ old('name', $product->name) }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="tagline">Tagline</label>
                        <input id="tagline" name="tagline" type="text" value="{{ old('tagline', $product->tagline) }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="description" rows="4" class="form-textarea">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="form-label" for="ingredients">Ingredients</label>
                            <textarea id="ingredients" name="ingredients" rows="3" class="form-textarea">{{ old('ingredients', $product->ingredients) }}</textarea>
                        </div>
                        <div>
                            <label class="form-label" for="allergen_info">Allergen info</label>
                            <textarea id="allergen_info" name="allergen_info" rows="3" class="form-textarea">{{ old('allergen_info', $product->allergen_info) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-6">
                <h2 class="mb-4 font-display text-lg font-extrabold text-ink">Image</h2>
                @if ($product->image_url)
                    <img src="{{ $product->image_url }}" alt="" class="mb-4 h-32 w-32 rounded-2xl object-cover ring-1 ring-berry-100">
                @endif
                <label class="form-label" for="image">Upload image</label>
                <input id="image" name="image" type="file" accept="image/*" class="form-input">
                <p class="mt-2 text-xs text-ink/50">Or paste an image URL:</p>
                <input name="image_url" type="text" value="{{ old('image_url') }}" placeholder="https://…" class="form-input mt-1">
            </div>
        </div>

        <div class="space-y-6">
            <div class="card p-6">
                <h2 class="mb-4 font-display text-lg font-extrabold text-ink">Pricing & Stock</h2>
                <div class="grid gap-4">
                    <div>
                        <label class="form-label" for="price">Price ($) *</label>
                        <input id="price" name="price" type="number" step="0.01" min="0" required value="{{ old('price', $product->price) }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="size">Size / net weight</label>
                        <input id="size" name="size" type="text" value="{{ old('size', $product->size) }}" class="form-input" placeholder="2 oz bag">
                    </div>
                    <div>
                        <label class="form-label" for="pack_quantity">Pack quantity *</label>
                        <input id="pack_quantity" name="pack_quantity" type="number" min="1" required value="{{ old('pack_quantity', $product->pack_quantity ?? 1) }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="stock">Stock <span class="font-normal text-ink/40">(blank = unlimited)</span></label>
                        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $product->stock) }}" class="form-input">
                    </div>
                </div>
            </div>

            <div class="card p-6">
                <h2 class="mb-4 font-display text-lg font-extrabold text-ink">Organize</h2>
                <div class="grid gap-4">
                    <div>
                        <label class="form-label" for="category_id">Category</label>
                        <select id="category_id" name="category_id" class="form-select">
                            <option value="">— None —</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="badge">Badge</label>
                        <input id="badge" name="badge" type="text" value="{{ old('badge', $product->badge) }}" class="form-input" placeholder="Best Value">
                    </div>
                    <div>
                        <label class="form-label" for="sort_order">Sort order</label>
                        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $product->sort_order ?? 0) }}" class="form-input">
                    </div>
                    <div class="space-y-2 pt-2">
                        @foreach ([
                            'is_active' => 'Active (visible in shop)',
                            'is_featured' => 'Featured',
                            'is_bundle' => 'Multi-pack / bundle',
                            'is_coming_soon' => 'Coming soon (not purchasable)',
                        ] as $field => $label)
                            <label class="flex items-center gap-2 text-sm font-semibold text-ink/80">
                                <input type="checkbox" name="{{ $field }}" value="1" class="rounded border-berry-200 text-berry-600 focus:ring-berry-400"
                                       @checked(old($field, $product->$field))>
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <button type="submit" class="btn-primary w-full">{{ $product->exists ? 'Update Product' : 'Create Product' }}</button>
                <a href="{{ route('admin.products.index') }}" class="btn-ghost w-full text-ink/50">Cancel</a>
            </div>
        </div>
    </form>
@endsection
