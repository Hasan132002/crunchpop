@php
    $nav = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Shop Candy', 'route' => 'shop.index'],
        ['label' => 'Custom Orders', 'route' => 'custom.index'],
        ['label' => 'About the Mission', 'route' => 'mission'],
        ['label' => 'Contact', 'route' => 'contact.index'],
    ];
@endphp
<header class="sticky top-0 z-50 border-b border-berry-100 bg-cream/90 backdrop-blur">
    <div class="section flex h-20 items-center justify-between gap-4">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
            <span class="grid h-11 w-11 place-items-center rounded-2xl bg-berry-500 text-2xl shadow-md">🍬</span>
            <span class="leading-tight">
                <span class="block font-display text-xl font-extrabold text-berry-600">CrunchPop Candy</span>
                <span class="block text-[11px] font-bold uppercase tracking-widest text-grape-500">by Field &amp; Pantry</span>
            </span>
        </a>

        {{-- Desktop nav --}}
        <nav class="hidden items-center gap-1 lg:flex">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="rounded-full px-4 py-2 text-sm font-bold transition
                          {{ request()->routeIs($item['route']) ? 'bg-berry-100 text-berry-700' : 'text-ink/70 hover:bg-white hover:text-berry-600' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Actions --}}
        <div class="flex items-center gap-2">
            <a href="{{ route('cart.index') }}"
               class="relative grid h-11 w-11 place-items-center rounded-full bg-white text-ink shadow-sm ring-1 ring-berry-100 transition hover:bg-berry-50"
               aria-label="View cart">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.137a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                @if ($cartCount > 0)
                    <span class="absolute -right-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-berry-500 px-1 text-[11px] font-extrabold text-white">{{ $cartCount }}</span>
                @endif
            </a>

            <a href="{{ route('shop.index') }}" class="btn-primary hidden sm:inline-flex !px-5 !py-2.5 text-sm">Shop Candy</a>

            {{-- Mobile toggle --}}
            <button type="button" data-nav-toggle aria-expanded="false" aria-label="Toggle menu"
                    class="grid h-11 w-11 place-items-center rounded-full bg-white text-ink shadow-sm ring-1 ring-berry-100 lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div data-nav-menu class="hidden border-t border-berry-100 bg-cream lg:hidden">
        <nav class="section flex flex-col gap-1 py-4">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="rounded-2xl px-4 py-3 text-base font-bold transition
                          {{ request()->routeIs($item['route']) ? 'bg-berry-100 text-berry-700' : 'text-ink/80 hover:bg-white' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ route('shop.index') }}" class="btn-primary mt-2">Shop Candy</a>
        </nav>
    </div>
</header>
