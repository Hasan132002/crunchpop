@props(['source' => 'website'])

@php
    $options = \App\Models\EarlyListSignup::INTEREST_OPTIONS;
@endphp

<section id="early-list" class="section py-16">
    <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-grape-600 via-berry-500 to-tangerine-400 px-6 py-12 shadow-xl sm:px-12">
        <div class="pointer-events-none absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/10"></div>
        <div class="pointer-events-none absolute -bottom-16 -left-8 h-56 w-56 rounded-full bg-white/10"></div>

        <div class="relative mx-auto max-w-3xl text-center text-white">
            <span class="chip bg-white/20 text-white">Be first to know</span>
            <h2 class="mt-4 font-display text-3xl font-extrabold sm:text-4xl">Be First to Know What Comes Next</h2>
            <p class="mx-auto mt-3 max-w-2xl text-white/90">
                CrunchPop Candy is just the beginning. Join the early Field &amp; Pantry list for future hurricane
                pantry products, custom freeze-drying updates, local availability, and first access when new products launch.
            </p>
        </div>

        <form action="{{ route('early-list.store') }}" method="POST" class="relative mx-auto mt-8 max-w-3xl rounded-3xl bg-white/95 p-6 shadow-lg sm:p-8">
            @csrf
            <input type="hidden" name="source" value="{{ $source }}">

            <div class="grid gap-4 sm:grid-cols-3">
                <div>
                    <label class="form-label" for="el-name">Name</label>
                    <input id="el-name" name="name" type="text" required value="{{ old('name') }}" class="form-input" placeholder="Your name">
                </div>
                <div>
                    <label class="form-label" for="el-email">Email</label>
                    <input id="el-email" name="email" type="email" required value="{{ old('email') }}" class="form-input" placeholder="you@email.com">
                </div>
                <div>
                    <label class="form-label" for="el-phone">Phone <span class="font-normal text-ink/40">(optional)</span></label>
                    <input id="el-phone" name="phone" type="tel" value="{{ old('phone') }}" class="form-input" placeholder="(555) 555-5555">
                </div>
            </div>

            <fieldset class="mt-5">
                <legend class="form-label">What are you interested in?</legend>
                <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($options as $value => $label)
                        <label class="flex cursor-pointer items-center gap-2 rounded-2xl bg-berry-50 px-3 py-2.5 text-sm font-semibold text-ink/80 ring-1 ring-berry-100 transition hover:bg-berry-100 has-[:checked]:bg-berry-500 has-[:checked]:text-white">
                            <input type="checkbox" name="interests[]" value="{{ $value }}"
                                   class="h-4 w-4 rounded border-berry-200 text-berry-600 focus:ring-berry-400"
                                   @checked(collect(old('interests'))->contains($value))>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </fieldset>

            <div class="mt-6 flex flex-col items-center gap-2">
                <button type="submit" class="btn-secondary w-full sm:w-auto">Join the Early List</button>
                <p class="text-center text-xs text-ink/50">A helpful invitation — never spam. Unsubscribe anytime.</p>
            </div>
        </form>
    </div>
</section>
