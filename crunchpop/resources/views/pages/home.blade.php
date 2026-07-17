@extends('layouts.app')

@section('title', 'CrunchPop Candy — Freeze-Dried Candy With a Bigger Purpose')

@section('content')

{{-- ============ SECTION 1: HERO ============ --}}
<section class="relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-berry-100 via-cream to-grape-100"></div>
    <div class="pointer-events-none absolute -right-16 top-10 h-72 w-72 rounded-full bg-tangerine-200/60 blur-2xl"></div>
    <div class="pointer-events-none absolute -left-16 bottom-0 h-72 w-72 rounded-full bg-skypop-200/60 blur-2xl"></div>

    <div class="section relative grid items-center gap-10 py-16 lg:grid-cols-2 lg:py-24">
        <div>
            <span class="chip bg-white text-berry-600 shadow-sm">🌴 South Florida made</span>
            <h1 class="mt-5 font-display text-5xl font-extrabold leading-[1.05] text-ink sm:text-6xl">
                CrunchPop <span class="text-berry-500">Candy</span>
            </h1>
            <p class="mt-4 font-display text-2xl font-bold text-grape-600">Freeze-dried candy with a bigger purpose.</p>
            <p class="mt-2 text-lg font-bold text-tangerine-500">Candy today. Prepared families tomorrow.</p>
            <p class="mt-5 max-w-xl text-lg text-ink/70">
                CrunchPop Candy is the fun first step of Field &amp; Pantry LLC, a South Florida food business building
                toward shelf-stable foods, hurricane preparedness, and practical emergency pantry options for local families.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('shop.index') }}" class="btn-primary">Shop Candy</a>
                <a href="{{ route('custom.index') }}" class="btn-outline">Custom Orders</a>
            </div>
        </div>

        <div class="relative">
            <div class="relative mx-auto aspect-square w-full max-w-md rotate-2 rounded-[3rem] bg-gradient-to-br from-berry-400 via-grape-400 to-tangerine-300 shadow-2xl">
                <div class="absolute inset-0 grid place-items-center text-[10rem]">🍬</div>
                <span class="chip absolute left-6 top-6 bg-white text-berry-600 shadow">Crunchy</span>
                <span class="chip absolute bottom-8 right-6 bg-white text-grape-600 shadow">Shelf-stable</span>
                <span class="chip absolute bottom-24 left-4 bg-white text-tangerine-600 shadow">Big flavor</span>
            </div>
        </div>
    </div>
</section>

{{-- ============ SECTION 2: MISSION STRIP ============ --}}
<section class="bg-lime-100">
    <div class="section flex flex-col items-center gap-4 py-8 text-center md:flex-row md:justify-center md:text-left">
        <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-lime-400 text-2xl text-white shadow">🛟</span>
        <p class="max-w-3xl text-lg font-semibold text-ink/80">
            Every bag helps move Field &amp; Pantry closer to its bigger mission: helping South Florida families
            prepare with food they know, trust, and will actually eat.
        </p>
    </div>
</section>

{{-- ============ SECTION 3: WHY CANDY FIRST ============ --}}
<section class="section py-20">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="font-display text-4xl font-extrabold text-ink">Why Candy First?</h2>
        <p class="mt-3 text-ink/60">We're starting small and sweet — here's the thinking behind it.</p>
    </div>

    <div class="mt-12 grid gap-6 md:grid-cols-3">
        @php
            $whyCards = [
                ['emoji' => '🎉', 'color' => 'bg-berry-100 text-berry-600', 'title' => 'It’s Fun', 'text' => 'Freeze-dried candy is colorful, crunchy, and easy for people to try.'],
                ['emoji' => '📈', 'color' => 'bg-grape-100 text-grape-600', 'title' => 'It Helps Us Grow', 'text' => 'Candy gives us a simple way to build customers, test packaging, and learn what people love.'],
                ['emoji' => '🧭', 'color' => 'bg-tangerine-100 text-tangerine-600', 'title' => 'It Leads Somewhere Bigger', 'text' => 'The long-term goal is practical shelf-stable food and hurricane preparedness for South Florida families.'],
            ];
        @endphp
        @foreach ($whyCards as $card)
            <div class="card p-8 text-center">
                <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl {{ $card['color'] }} text-3xl">{{ $card['emoji'] }}</div>
                <h3 class="mt-5 font-display text-xl font-extrabold text-ink">{{ $card['title'] }}</h3>
                <p class="mt-2 text-ink/60">{{ $card['text'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ SECTION 4: PRODUCT PREVIEW ============ --}}
<section class="bg-berry-50 py-20">
    <div class="section">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h2 class="font-display text-4xl font-extrabold text-ink">Taste the Crunch</h2>
                <p class="mt-2 text-ink/60">A quick peek at what's popping in the shop.</p>
            </div>
            <a href="{{ route('shop.index') }}" class="btn-ghost text-berry-600">View all candy →</a>
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($previewProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>

{{-- ============ SECTION 5: FIELD & PANTRY CONNECTION ============ --}}
<section class="section py-20">
    <div class="grid items-center gap-10 lg:grid-cols-2">
        <div class="order-2 lg:order-1">
            <div class="relative aspect-[4/3] overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-skypop-300 via-grape-300 to-berry-300 shadow-xl">
                <div class="absolute inset-0 grid place-items-center text-8xl">🏡</div>
                <div class="absolute bottom-4 left-4 flex gap-2">
                    <span class="chip bg-white/90 text-grape-600">Pantry</span>
                    <span class="chip bg-white/90 text-berry-600">Preparedness</span>
                    <span class="chip bg-white/90 text-tangerine-600">Family food</span>
                </div>
            </div>
        </div>
        <div class="order-1 lg:order-2">
            <span class="chip bg-grape-100 text-grape-600">The bigger picture</span>
            <h2 class="mt-4 font-display text-4xl font-extrabold text-ink">More Than Candy</h2>
            <p class="mt-4 text-lg text-ink/70">
                CrunchPop Candy is part of Field &amp; Pantry LLC. We are starting with fun, shelf-stable candy, but the
                bigger mission is to help families prepare for hurricane season, power outages, and hard times with
                food they actually want to eat.
            </p>
            <a href="{{ route('mission') }}" class="btn-secondary mt-8">Learn About Field &amp; Pantry</a>
        </div>
    </div>
</section>

{{-- ============ SECTION 6: LOCAL ORDERS / EVENTS / FUNDRAISERS ============ --}}
<section class="bg-grape-50 py-20">
    <div class="section">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="font-display text-4xl font-extrabold text-ink">Perfect for Local Events</h2>
            <p class="mt-3 text-ink/60">Bring the crunch to your next celebration, team, or fundraiser.</p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-3">
            @php
                $eventCards = [
                    ['emoji' => '🎈', 'color' => 'bg-berry-100 text-berry-600', 'title' => 'Parties', 'text' => 'Custom candy bags for birthdays, family events, and celebrations.'],
                    ['emoji' => '⚾', 'color' => 'bg-skypop-100 text-skypop-500', 'title' => 'Teams & Scouts', 'text' => 'Options for baseball teams, Boy Scouts, Girl Scouts, clubs, and school groups.'],
                    ['emoji' => '💛', 'color' => 'bg-tangerine-100 text-tangerine-600', 'title' => 'Fundraisers', 'text' => 'A fun candy option for local fundraising and community groups.'],
                ];
            @endphp
            @foreach ($eventCards as $card)
                <div class="card p-8 text-center">
                    <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl {{ $card['color'] }} text-3xl">{{ $card['emoji'] }}</div>
                    <h3 class="mt-5 font-display text-xl font-extrabold text-ink">{{ $card['title'] }}</h3>
                    <p class="mt-2 text-ink/60">{{ $card['text'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('custom.index') }}" class="btn-primary">Request a Custom Order</a>
        </div>
    </div>
</section>

{{-- ============ EARLY LIST SIGNUP ============ --}}
<x-early-list source="home" />

{{-- ============ SECTION 7: FINAL CTA ============ --}}
<section class="section pb-24">
    <div class="relative overflow-hidden rounded-[2.5rem] bg-ink px-6 py-16 text-center shadow-xl sm:px-12">
        <div class="pointer-events-none absolute -left-10 -top-10 h-40 w-40 rounded-full bg-berry-500/30 blur-2xl"></div>
        <div class="pointer-events-none absolute -bottom-10 -right-10 h-40 w-40 rounded-full bg-tangerine-400/30 blur-2xl"></div>
        <h2 class="relative font-display text-4xl font-extrabold text-white sm:text-5xl">Start with candy. Stay for the mission.</h2>
        <p class="relative mx-auto mt-4 max-w-xl text-lg text-cream/70">
            Shop CrunchPop Candy today and help build something bigger for South Florida families.
        </p>
        <div class="relative mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ route('shop.index') }}" class="btn-primary">Shop Candy</a>
            <a href="{{ route('custom.index') }}" class="btn-sunny">Custom Orders</a>
        </div>
    </div>
</section>

@endsection
