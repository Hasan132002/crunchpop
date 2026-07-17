@extends('admin.layout')

@section('title', 'Message')
@section('heading', 'Message')

@section('actions')
    <a href="{{ route('admin.contacts.index') }}" class="btn-ghost !py-2.5 text-sm text-ink/50">← Back</a>
@endsection

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="card p-8">
            <div class="flex flex-wrap items-start justify-between gap-4 border-b border-berry-50 pb-5">
                <div>
                    <h2 class="font-display text-xl font-extrabold text-ink">{{ $contact->subject ?: '(no subject)' }}</h2>
                    <p class="mt-1 text-sm text-ink/60">
                        From <span class="font-semibold text-ink">{{ $contact->name }}</span>
                        · <a href="mailto:{{ $contact->email }}" class="text-berry-600 hover:underline">{{ $contact->email }}</a>
                        @if ($contact->phone) · {{ $contact->phone }} @endif
                    </p>
                </div>
                <span class="text-sm text-ink/40">{{ $contact->created_at->format('M j, Y g:i A') }}</span>
            </div>

            <p class="mt-5 whitespace-pre-line leading-relaxed text-ink/80">{{ $contact->message }}</p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'Your message') }}" class="btn-primary">✉️ Reply</a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                    @csrf @method('DELETE')
                    <button class="btn-ghost text-berry-600 hover:bg-berry-50">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
