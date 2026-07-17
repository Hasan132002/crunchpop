@extends('admin.layout')

@section('title', 'Custom Request')
@section('heading', 'Custom Request')

@section('actions')
    <a href="{{ route('admin.custom-orders.index') }}" class="btn-ghost !py-2.5 text-sm text-ink/50">← Back</a>
@endsection

@section('content')
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="card p-6 lg:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="font-display text-lg font-extrabold text-ink">{{ $req->name }}</h2>
                <x-status-badge :status="$req->status" />
            </div>
            <dl class="grid gap-4 sm:grid-cols-2">
                @php
                    $fields = [
                        'Email' => $req->email,
                        'Phone' => $req->phone,
                        'Organization' => $req->organization,
                        'Event type' => $req->event_type,
                        'Event date' => $req->event_date?->format('M j, Y'),
                        'Guests / bags' => $req->guest_count,
                        'Candy type' => $req->candy_type,
                        'Bag size' => $req->bag_size,
                        'Budget' => $req->budget_range,
                        'Fulfillment' => $req->fulfillment_preference ? ucfirst($req->fulfillment_preference) : null,
                    ];
                @endphp
                @foreach ($fields as $label => $value)
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wide text-ink/40">{{ $label }}</dt>
                        <dd class="mt-0.5 font-semibold text-ink/80">{{ $value ?: '—' }}</dd>
                    </div>
                @endforeach
            </dl>
            @if ($req->message)
                <div class="mt-6 border-t border-berry-50 pt-4">
                    <dt class="text-xs font-bold uppercase tracking-wide text-ink/40">Message</dt>
                    <p class="mt-1 whitespace-pre-line text-ink/70">{{ $req->message }}</p>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="card p-6">
                <h2 class="mb-4 font-display text-lg font-extrabold text-ink">Update Status</h2>
                <form action="{{ route('admin.custom-orders.status', $req) }}" method="POST" class="flex gap-2">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected($req->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button class="btn-primary shrink-0 !px-4 !py-2.5 text-sm">Save</button>
                </form>
                <a href="mailto:{{ $req->email }}" class="btn-secondary mt-3 w-full !py-2.5 text-sm">✉️ Reply by email</a>
            </div>

            <form action="{{ route('admin.custom-orders.destroy', $req) }}" method="POST" onsubmit="return confirm('Delete this request?')">
                @csrf @method('DELETE')
                <button class="btn-ghost w-full text-berry-600 hover:bg-berry-50">Delete request</button>
            </form>
        </div>
    </div>
@endsection
