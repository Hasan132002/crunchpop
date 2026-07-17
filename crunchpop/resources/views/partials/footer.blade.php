<footer class="mt-24 bg-ink text-cream/80">
    <div class="section grid gap-10 py-14 md:grid-cols-2 lg:grid-cols-4">
        {{-- Brand --}}
        <div>
            <div class="flex items-center gap-3">
                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-berry-500 text-2xl">🍬</span>
                <span class="leading-tight">
                    <span class="block font-display text-lg font-extrabold text-white">CrunchPop Candy</span>
                    <span class="block text-[11px] font-bold uppercase tracking-widest text-grape-300">Field &amp; Pantry LLC</span>
                </span>
            </div>
            <p class="mt-4 font-display text-lg font-bold text-tangerine-300">Candy today.<br>Prepared families tomorrow.</p>
            <p class="mt-3 max-w-xs text-sm">Bright, crunchy freeze-dried candy — the fun first step toward South Florida hurricane preparedness.</p>
        </div>

        {{-- Explore --}}
        <div>
            <h3 class="font-display text-sm font-extrabold uppercase tracking-widest text-white">Explore</h3>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="transition hover:text-berry-300">Home</a></li>
                <li><a href="{{ route('shop.index') }}" class="transition hover:text-berry-300">Shop Candy</a></li>
                <li><a href="{{ route('custom.index') }}" class="transition hover:text-berry-300">Custom Orders</a></li>
                <li><a href="{{ route('mission') }}" class="transition hover:text-berry-300">About the Mission</a></li>
                <li><a href="{{ route('contact.index') }}" class="transition hover:text-berry-300">Contact</a></li>
            </ul>
        </div>

        {{-- Info --}}
        <div>
            <h3 class="font-display text-sm font-extrabold uppercase tracking-widest text-white">Info</h3>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a href="#" class="transition hover:text-berry-300">Shipping</a></li>
                <li><a href="#" class="transition hover:text-berry-300">Returns</a></li>
                <li><a href="#" class="transition hover:text-berry-300">Privacy Policy</a></li>
                <li><a href="#" class="transition hover:text-berry-300">Terms</a></li>
            </ul>
            <p class="mt-4 text-xs leading-relaxed text-cream/50">
                Cottage food notice: Made in a home kitchen where required by Florida cottage food law. Not inspected by the Department of Agriculture.
            </p>
        </div>

        {{-- Contact + social --}}
        <div>
            <h3 class="font-display text-sm font-extrabold uppercase tracking-widest text-white">Say Hello</h3>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a href="mailto:hello@crunchpopcandy.com" class="transition hover:text-berry-300">hello@crunchpopcandy.com</a></li>
                <li class="text-cream/60">South Florida, USA</li>
            </ul>
            <div class="mt-4 flex gap-3">
                @foreach (['Instagram' => 'IG', 'Facebook' => 'FB', 'TikTok' => 'TT'] as $name => $abbr)
                    <a href="#" aria-label="{{ $name }}"
                       class="grid h-10 w-10 place-items-center rounded-full bg-white/10 text-xs font-extrabold text-white transition hover:bg-berry-500">{{ $abbr }}</a>
                @endforeach
            </div>
            <a href="{{ route('mission') }}#early-list" class="btn-sunny mt-5 !py-2.5 text-sm">Join the Early List</a>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="section flex flex-col items-center justify-between gap-2 py-6 text-xs text-cream/50 sm:flex-row">
            <p>&copy; {{ date('Y') }} Field &amp; Pantry LLC. All rights reserved.</p>
            <p>CrunchPop Candy is a product of Field &amp; Pantry LLC.</p>
        </div>
    </div>
</footer>
