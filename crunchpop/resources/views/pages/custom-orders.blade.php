@extends('layouts.app')

@section('title', 'Custom Candy Orders for Parties, Teams & Events')
@section('meta_description', 'Freeze-dried candy bags for birthdays, fundraisers, scouts, sports teams, local events, and group orders.')

@section('content')

{{-- ============ HERO ============ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-grape-100 via-cream to-berry-100">
    <div class="section grid items-center gap-8 py-16 lg:grid-cols-2">
        <div>
            <span class="chip bg-white text-grape-600 shadow-sm">🎉 Custom Orders &amp; Events</span>
            <h1 class="mt-5 font-display text-4xl font-extrabold leading-tight text-ink sm:text-5xl">
                Custom Candy Orders for Parties, Teams &amp; Events
            </h1>
            <p class="mt-4 font-display text-xl font-bold text-berry-600">
                Freeze-dried candy bags for birthdays, fundraisers, scouts, sports teams, local events, and group orders.
            </p>
            <p class="mt-3 max-w-xl text-ink/70">
                CrunchPop Candy can help create fun candy options for parties, school groups, teams, clubs, fundraisers, and community events.
            </p>
            <a href="#custom-form" class="btn-primary mt-8">Request a Custom Order</a>
        </div>
        <div class="relative mx-auto aspect-square w-full max-w-sm -rotate-2 rounded-[3rem] bg-gradient-to-br from-tangerine-300 via-berry-400 to-grape-400 shadow-2xl">
            <div class="absolute inset-0 grid place-items-center text-[9rem]">🎁</div>
        </div>
    </div>
</section>

{{-- ============ WHO THIS IS FOR ============ --}}
<section class="section py-20">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="font-display text-4xl font-extrabold text-ink">Who This Is For</h2>
        <p class="mt-3 text-ink/60">If it's a celebration or a cause, we can make it sweet.</p>
    </div>
    <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
        @php
            $who = [
                ['🎂', 'Birthday Parties', 'Custom candy bags to make the day extra sweet.'],
                ['🏕️', 'Boy Scouts', 'Fun treats and options for troop events and camps.'],
                ['🍪', 'Girl Scouts', 'A colorful add-on for meetings and outings.'],
                ['⚾', 'Baseball Teams', 'Team snacks and post-game crunch for players.'],
                ['🏫', 'School Events', 'Easy candy options for school days and celebrations.'],
                ['⛪', 'Church Groups', 'Shareable treats for gatherings and youth groups.'],
                ['💰', 'Fundraisers', 'A simple, fun product for raising funds locally.'],
                ['🏢', 'Corporate Gifts', 'Bright, memorable gifts for clients and teams.'],
                ['🏬', 'Local Pop-Ups', 'Stock your booth or table with crunchy candy.'],
                ['🎀', 'Party Favors', 'Send guests home with a sweet little thank-you.'],
            ];
        @endphp
        @foreach ($who as [$emoji, $title, $desc])
            <div class="card p-5 text-center">
                <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-berry-50 text-2xl">{{ $emoji }}</div>
                <h3 class="mt-3 font-display font-extrabold text-ink">{{ $title }}</h3>
                <p class="mt-1 text-sm text-ink/60">{{ $desc }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ HOW IT WORKS ============ --}}
<section class="bg-skypop-50 py-20">
    <div class="section">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="font-display text-4xl font-extrabold text-ink">How Custom Orders Work</h2>
            <p class="mt-3 text-ink/60">Three simple steps from idea to candy.</p>
        </div>
        <div class="mt-12 grid gap-6 md:grid-cols-3">
            @php
                $steps = [
                    ['1', 'Tell Us What You Need', 'Share your event type, date, group size, and candy ideas.'],
                    ['2', 'We Help Plan the Candy', 'We’ll help match candy options, bag sizes, labels, and quantities.'],
                    ['3', 'Pick Up or Ship', 'We’ll prepare the order and coordinate pickup, delivery, or shipping where available.'],
                ];
            @endphp
            @foreach ($steps as [$num, $title, $text])
                <div class="card relative p-8">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-berry-500 font-display text-xl font-extrabold text-white shadow">{{ $num }}</span>
                    <h3 class="mt-5 font-display text-xl font-extrabold text-ink">{{ $title }}</h3>
                    <p class="mt-2 text-ink/60">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ CUSTOM ORDER OPTIONS ============ --}}
<section class="section py-20">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="font-display text-4xl font-extrabold text-ink">Custom Order Options</h2>
        <p class="mt-3 text-ink/60">Mix and match to fit your event.</p>
    </div>
    <div class="mx-auto mt-10 grid max-w-4xl gap-3 sm:grid-cols-2">
        @php
            $options = [
                'Individual candy bags', 'Multi-pack bundles', 'Party favor bags', 'Fundraiser packs',
                'Team or group orders', 'Seasonal candy batches', 'Local event orders', 'Custom label options (coming later)',
            ];
        @endphp
        @foreach ($options as $option)
            <div class="flex items-center gap-3 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-berry-50">
                <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-lime-100 text-lime-500">✓</span>
                <span class="font-semibold text-ink/80">{{ $option }}</span>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ CUSTOM ORDER FORM ============ --}}
<section id="custom-form" class="bg-berry-50 py-20">
    <div class="section">
        <div class="mx-auto max-w-3xl">
            <div class="text-center">
                <h2 class="font-display text-4xl font-extrabold text-ink">Request a Custom Order</h2>
                <p class="mt-3 text-ink/60">Tell us about your event and we'll help plan the perfect candy.</p>
            </div>

            <form action="{{ route('custom.store') }}" method="POST" class="card mt-10 p-6 sm:p-10">
                @csrf
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="form-label" for="co-name">Name *</label>
                        <input id="co-name" name="name" type="text" required value="{{ old('name') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="co-email">Email *</label>
                        <input id="co-email" name="email" type="email" required value="{{ old('email') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="co-phone">Phone</label>
                        <input id="co-phone" name="phone" type="tel" value="{{ old('phone') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="co-org">Organization / Group Name</label>
                        <input id="co-org" name="organization" type="text" value="{{ old('organization') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="co-event-type">Event Type</label>
                        <input id="co-event-type" name="event_type" type="text" value="{{ old('event_type') }}" class="form-input" placeholder="Birthday, fundraiser, team event…">
                    </div>
                    <div>
                        <label class="form-label" for="co-event-date">Event Date</label>
                        <input id="co-event-date" name="event_date" type="date" value="{{ old('event_date') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="co-guests">Number of Guests / Bags Needed</label>
                        <input id="co-guests" name="guest_count" type="text" value="{{ old('guest_count') }}" class="form-input" placeholder="e.g. 50 bags">
                    </div>
                    <div>
                        <label class="form-label" for="co-candy">Candy Type Interested In</label>
                        <input id="co-candy" name="candy_type" type="text" value="{{ old('candy_type') }}" class="form-input" placeholder="Sour Rainbow Crunchers…">
                    </div>
                    <div>
                        <label class="form-label" for="co-bag">Bag Size Interested In</label>
                        <select id="co-bag" name="bag_size" class="form-select">
                            <option value="">No preference</option>
                            @foreach (['2 oz bags', '4 oz bags', 'Party favor size', 'Multi-packs', 'Mixed'] as $bag)
                                <option value="{{ $bag }}" @selected(old('bag_size') === $bag)>{{ $bag }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="co-budget">Budget Range</label>
                        <select id="co-budget" name="budget_range" class="form-select">
                            <option value="">Not sure yet</option>
                            @foreach (['Under $100', '$100 – $250', '$250 – $500', '$500 – $1,000', '$1,000+'] as $budget)
                                <option value="{{ $budget }}" @selected(old('budget_range') === $budget)>{{ $budget }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label">Pickup or Shipping Preference</label>
                        <div class="grid gap-3 sm:grid-cols-3">
                            @foreach (['pickup' => '📍 Pickup', 'shipping' => '🚚 Shipping', 'either' => '🤝 Either'] as $val => $label)
                                <label class="flex cursor-pointer items-center gap-2 rounded-2xl bg-cream p-3 text-sm font-semibold ring-1 ring-berry-100 transition has-[:checked]:bg-berry-500 has-[:checked]:text-white">
                                    <input type="radio" name="fulfillment_preference" value="{{ $val }}" class="text-berry-600 focus:ring-berry-400" @checked(old('fulfillment_preference') === $val)>
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label" for="co-message">Message / Details</label>
                        <textarea id="co-message" name="message" rows="4" class="form-textarea" placeholder="Tell us more about what you're planning…">{{ old('message') }}</textarea>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="btn-primary w-full sm:w-auto">Send Custom Order Request</button>
                    <p class="mt-4 text-sm text-ink/50">
                        Custom orders are reviewed individually. Submitting this form does not guarantee availability, but we will reply as soon as possible.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- ============ FUNDRAISING MESSAGE ============ --}}
<section class="section py-16">
    <div class="grid items-center gap-8 rounded-[2.5rem] bg-gradient-to-r from-tangerine-400 to-berry-500 p-8 text-white shadow-xl sm:p-12 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <h2 class="font-display text-3xl font-extrabold">Looking for a Fun Fundraiser?</h2>
            <p class="mt-3 max-w-2xl text-white/90">
                CrunchPop Candy can be a simple, fun option for local teams, scout groups, clubs, schools, and community organizations.
            </p>
        </div>
        <div class="lg:text-right">
            <a href="#custom-form" class="btn-outline !bg-white">Ask About Fundraising</a>
        </div>
    </div>
</section>

{{-- ============ FINAL CTA ============ --}}
<section class="section pb-8">
    <div class="rounded-[2.5rem] bg-ink px-6 py-14 text-center shadow-xl sm:px-12">
        <h2 class="font-display text-4xl font-extrabold text-white">Planning something sweet?</h2>
        <p class="mx-auto mt-4 max-w-xl text-cream/70">Tell us what you're planning and we'll help you figure out the candy.</p>
        <a href="#custom-form" class="btn-primary mt-8">Request a Custom Order</a>
    </div>
</section>

<x-early-list source="custom-orders" />

@endsection
