@extends('admin.layout')

@section('title', 'Products')
@section('heading', 'Products')

@section('actions')
    <a href="{{ route('admin.products.create') }}" class="btn-primary !py-2.5 text-sm">+ New Product</a>
@endsection

@section('content')
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-berry-50 text-xs uppercase tracking-wide text-ink/50">
                    <tr>
                        <th class="px-5 py-4">Product</th>
                        <th class="px-5 py-4">Category</th>
                        <th class="px-5 py-4">Size</th>
                        <th class="px-5 py-4">Price</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-berry-50">
                    @forelse ($products as $product)
                        <tr class="hover:bg-berry-50/50">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-berry-200 to-grape-300 text-xl">
                                        @if ($product->image_url)<img src="{{ $product->image_url }}" class="h-full w-full rounded-xl object-cover" alt="">@else 🍬 @endif
                                    </span>
                                    <div>
                                        <span class="block font-bold text-ink">{{ $product->name }}</span>
                                        @if ($product->badge)<span class="text-xs text-grape-500">{{ $product->badge }}</span>@endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-ink/60">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-5 py-4 text-ink/60">{{ $product->size ?? '—' }}</td>
                            <td class="px-5 py-4 font-bold">${{ number_format($product->price, 2) }}</td>
                            <td class="px-5 py-4">
                                @if ($product->is_coming_soon)
                                    <span class="chip bg-grape-100 text-grape-600">Coming soon</span>
                                @elseif ($product->is_active)
                                    <span class="chip bg-lime-100 text-lime-500">Active</span>
                                @else
                                    <span class="chip bg-ink/10 text-ink/50">Hidden</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="rounded-full bg-berry-50 px-3 py-1.5 text-xs font-bold text-berry-600 hover:bg-berry-100">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                        @csrf @method('DELETE')
                                        <button class="rounded-full bg-ink/5 px-3 py-1.5 text-xs font-bold text-ink/50 hover:bg-berry-100 hover:text-berry-600">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-ink/40">No products yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $products->links() }}</div>
@endsection
