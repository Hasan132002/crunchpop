<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', [
            'product'    => new Product(['is_active' => true, 'pack_quantity' => 1]),
            'categories' => Category::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);
        $data = $this->handleImage($request, $data);
        $data['slug'] = Product::uniqueSlug($data['name']);

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'product'    => $product,
            'categories' => Category::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);
        $data = $this->handleImage($request, $data, $product);

        if ($data['name'] !== $product->name) {
            $data['slug'] = Product::uniqueSlug($data['name'], $product->id);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && ! str_starts_with($product->image, 'http') && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return back()->with('success', 'Product deleted.');
    }

    protected function validateProduct(Request $request): array
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:160'],
            'category_id'    => ['nullable', 'exists:categories,id'],
            'tagline'        => ['nullable', 'string', 'max:200'],
            'description'    => ['nullable', 'string', 'max:2000'],
            'size'           => ['nullable', 'string', 'max:80'],
            'price'          => ['required', 'numeric', 'min:0', 'max:99999'],
            'pack_quantity'  => ['required', 'integer', 'min:1', 'max:999'],
            'badge'          => ['nullable', 'string', 'max:40'],
            'ingredients'    => ['nullable', 'string', 'max:2000'],
            'allergen_info'  => ['nullable', 'string', 'max:2000'],
            'stock'          => ['nullable', 'integer', 'min:0'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
            'image'          => ['nullable', 'image', 'max:4096'],
            'image_url'      => ['nullable', 'string', 'max:400'],
        ]);

        $validated['is_bundle']      = $request->boolean('is_bundle');
        $validated['is_coming_soon'] = $request->boolean('is_coming_soon');
        $validated['is_featured']    = $request->boolean('is_featured');
        $validated['is_active']      = $request->boolean('is_active');
        $validated['sort_order']     = $validated['sort_order'] ?? 0;

        return $validated;
    }

    protected function handleImage(Request $request, array $data, ?Product $product = null): array
    {
        // Uploaded file takes priority
        if ($request->hasFile('image')) {
            if ($product && $product->image && ! str_starts_with($product->image, 'http')
                && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        } elseif (! empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
        } else {
            unset($data['image']); // keep existing
        }

        unset($data['image_url']);

        return $data;
    }
}
