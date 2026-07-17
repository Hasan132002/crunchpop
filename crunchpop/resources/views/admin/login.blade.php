<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — CrunchPop</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=baloo-2:600,700,800|nunito:400,600,700,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="grid min-h-screen place-items-center bg-gradient-to-br from-berry-100 via-cream to-grape-100 p-4">
    <div class="w-full max-w-md">
        <div class="mb-6 text-center">
            <span class="inline-grid h-16 w-16 place-items-center rounded-3xl bg-berry-500 text-3xl shadow-lg">🍬</span>
            <h1 class="mt-4 font-display text-3xl font-extrabold text-berry-600">CrunchPop Admin</h1>
            <p class="text-ink/60">Sign in to manage the shop.</p>
        </div>

        <div class="card p-8">
            @if (session('error'))
                <div class="mb-4 rounded-2xl bg-berry-500 px-4 py-3 text-sm font-bold text-white">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="mb-4 rounded-2xl bg-lime-500 px-4 py-3 text-sm font-bold text-white">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.login.attempt') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="form-label" for="email">Email</label>
                    <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}" class="form-input @error('email') ring-2 ring-berry-400 @enderror">
                    @error('email')<p class="mt-1 text-sm font-semibold text-berry-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="form-label" for="password">Password</label>
                    <input id="password" name="password" type="password" required class="form-input">
                </div>
                <label class="flex items-center gap-2 text-sm font-semibold text-ink/70">
                    <input type="checkbox" name="remember" class="rounded border-berry-200 text-berry-600 focus:ring-berry-400"> Remember me
                </label>
                <button type="submit" class="btn-primary w-full">Sign In</button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-ink/50">
            <a href="{{ route('home') }}" class="font-bold hover:text-berry-600">← Back to CrunchPop Candy</a>
        </p>
    </div>
</body>
</html>
