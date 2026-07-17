@if (session('success') || session('error') || $errors->any())
    <div class="section pointer-events-none fixed inset-x-0 top-24 z-[60] flex flex-col items-center gap-3 px-4">
        @if (session('success'))
            <div data-flash class="pointer-events-auto flex w-full max-w-md items-start gap-3 rounded-2xl bg-lime-500 px-5 py-4 text-white shadow-lg">
                <span class="text-lg">✅</span>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div data-flash class="pointer-events-auto flex w-full max-w-md items-start gap-3 rounded-2xl bg-berry-500 px-5 py-4 text-white shadow-lg">
                <span class="text-lg">⚠️</span>
                <p class="font-bold">{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div data-flash class="pointer-events-auto w-full max-w-md rounded-2xl bg-tangerine-500 px-5 py-4 text-white shadow-lg">
                <p class="mb-1 font-extrabold">Please check the form:</p>
                <ul class="list-inside list-disc text-sm font-semibold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endif
