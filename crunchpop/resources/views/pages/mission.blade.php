@extends('layouts.app')

@section('title', 'About the Mission — Field & Pantry')
@section('meta_description', 'CrunchPop Candy is the fun front door to Field & Pantry LLC — building toward shelf-stable food and practical hurricane preparedness for South Florida families.')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden bg-gradient-to-br from-lime-100 via-cream to-skypop-100">
    <div class="section py-16 text-center">
        <span class="chip bg-white text-lime-500 shadow-sm">🌀 The bigger mission</span>
        <h1 class="mx-auto mt-5 max-w-3xl font-display text-4xl font-extrabold leading-tight text-ink sm:text-5xl">
            Candy today. Prepared families tomorrow.
        </h1>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-ink/70">
            CrunchPop Candy is the fun front door to Field &amp; Pantry LLC — a South Florida food business building
            toward shelf-stable food and practical hurricane readiness for local families.
        </p>
    </div>
</section>

{{-- STORY --}}
<section class="section py-20">
    <div class="grid items-center gap-12 lg:grid-cols-2">
        <div>
            <h2 class="font-display text-3xl font-extrabold text-ink">Why Field &amp; Pantry Exists</h2>
            <div class="mt-5 space-y-4 text-ink/70">
                <p>In South Florida, hurricane season isn't a maybe — it's a yearly reality. Power goes out, stores empty, and families are left with whatever they managed to grab.</p>
                <p>Field &amp; Pantry is building toward a better answer: practical, shelf-stable food that families actually <em>want</em> to eat — not just survive on. Real food, ready before it's needed.</p>
                <p>We're starting with something bright and joyful: freeze-dried candy. It's the fun first step that helps us grow, learn, and build a community before the bigger preparedness line arrives.</p>
            </div>
        </div>
        <div class="relative aspect-[4/3] overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-grape-300 via-berry-300 to-tangerine-300 shadow-xl">
            <div class="absolute inset-0 grid place-items-center text-8xl">🌴</div>
        </div>
    </div>
</section>

{{-- PILLARS --}}
<section class="bg-berry-50 py-20">
    <div class="section">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="font-display text-4xl font-extrabold text-ink">What We're Building Toward</h2>
            <p class="mt-3 text-ink/60">A step-by-step path from candy to preparedness.</p>
        </div>
        <div class="mt-12 grid gap-6 md:grid-cols-3">
            @php
                $pillars = [
                    ['🍬', 'bg-berry-100 text-berry-600', 'Freeze-Dried Candy', 'Available now — bright, crunchy, shelf-stable treats that fund the mission.'],
                    ['🥫', 'bg-tangerine-100 text-tangerine-600', 'Shelf-Stable Food', 'Coming next — practical, tasty food families can store and rely on.'],
                    ['🛟', 'bg-skypop-100 text-skypop-500', 'Hurricane Preparedness', 'The goal — helping South Florida families prepare before they need to.'],
                ];
            @endphp
            @foreach ($pillars as [$emoji, $color, $title, $text])
                <div class="card p-8 text-center">
                    <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl {{ $color }} text-3xl">{{ $emoji }}</div>
                    <h3 class="mt-5 font-display text-xl font-extrabold text-ink">{{ $title }}</h3>
                    <p class="mt-2 text-ink/60">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- VALUES --}}
<section class="section py-20">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="font-display text-4xl font-extrabold text-ink">How We Do It</h2>
    </div>
    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @php
            $values = [
                ['🤝', 'Local & friendly', 'Built by and for South Florida families.'],
                ['✅', 'Honest', 'No fear tactics — just helpful, practical prep.'],
                ['😋', 'Food you’ll eat', 'Preparedness that actually tastes good.'],
                ['🌱', 'Growing carefully', 'Small batches, real feedback, steady steps.'],
            ];
        @endphp
        @foreach ($values as [$emoji, $title, $text])
            <div class="rounded-3xl bg-white p-6 text-center shadow-sm ring-1 ring-berry-50">
                <div class="text-3xl">{{ $emoji }}</div>
                <h3 class="mt-3 font-display font-extrabold text-ink">{{ $title }}</h3>
                <p class="mt-1 text-sm text-ink/60">{{ $text }}</p>
            </div>
        @endforeach
    </div>
</section>

<x-early-list source="mission" />

{{-- CTA --}}
<section class="section pb-8">
    <div class="rounded-[2.5rem] bg-gradient-to-r from-grape-500 to-berry-500 px-6 py-14 text-center shadow-xl">
        <h2 class="font-display text-4xl font-extrabold text-white">Start with candy. Stay for the mission.</h2>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ route('shop.index') }}" class="btn-outline !bg-white">Shop Candy</a>
            <a href="{{ route('custom.index') }}" class="btn-sunny">Custom Orders</a>
        </div>
    </div>
</section>

@endsection
