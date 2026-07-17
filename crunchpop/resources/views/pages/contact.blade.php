@extends('layouts.app')

@section('title', 'Contact CrunchPop Candy')
@section('meta_description', 'Get in touch with CrunchPop Candy and Field & Pantry LLC — questions, orders, events, and wholesale.')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-skypop-100 via-cream to-grape-100">
    <div class="section py-14 text-center">
        <span class="chip bg-white text-skypop-500 shadow-sm">💌 Say hello</span>
        <h1 class="mt-5 font-display text-5xl font-extrabold text-ink">Contact Us</h1>
        <p class="mx-auto mt-3 max-w-xl text-ink/60">Questions about candy, custom orders, events, or the bigger mission? We'd love to hear from you.</p>
    </div>
</section>

<section class="section py-16">
    <div class="grid gap-10 lg:grid-cols-3">
        {{-- Info --}}
        <div class="space-y-4">
            @php
                $cards = [
                    ['✉️', 'Email us', 'hello@crunchpopcandy.com', 'mailto:hello@crunchpopcandy.com'],
                    ['📍', 'Where we are', 'South Florida, USA', null],
                    ['🎉', 'Custom orders', 'Plan an event or fundraiser', route('custom.index')],
                    ['🌀', 'The mission', 'Learn about Field & Pantry', route('mission')],
                ];
            @endphp
            @foreach ($cards as [$emoji, $title, $text, $link])
                <div class="card flex items-start gap-4 p-5">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-berry-50 text-2xl">{{ $emoji }}</span>
                    <div>
                        <h3 class="font-display font-extrabold text-ink">{{ $title }}</h3>
                        @if ($link)
                            <a href="{{ $link }}" class="text-sm font-semibold text-berry-600 hover:underline">{{ $text }}</a>
                        @else
                            <p class="text-sm text-ink/60">{{ $text }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Form --}}
        <div class="lg:col-span-2">
            <form action="{{ route('contact.store') }}" method="POST" class="card p-6 sm:p-10">
                @csrf
                <h2 class="font-display text-2xl font-extrabold text-ink">Send a Message</h2>
                <div class="mt-6 grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="form-label" for="c-name">Name *</label>
                        <input id="c-name" name="name" type="text" required value="{{ old('name') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="c-email">Email *</label>
                        <input id="c-email" name="email" type="email" required value="{{ old('email') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="c-phone">Phone <span class="font-normal text-ink/40">(optional)</span></label>
                        <input id="c-phone" name="phone" type="tel" value="{{ old('phone') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="c-subject">Subject</label>
                        <input id="c-subject" name="subject" type="text" value="{{ old('subject') }}" class="form-input">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label" for="c-message">Message *</label>
                        <textarea id="c-message" name="message" rows="5" required class="form-textarea">{{ old('message') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn-primary mt-6 w-full sm:w-auto">Send Message</button>
            </form>
        </div>
    </div>
</section>

<x-early-list source="contact" />

@endsection
