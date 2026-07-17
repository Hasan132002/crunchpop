@extends('admin.layout')

@section('title', 'Custom Orders')
@section('heading', 'Custom Order Requests')

@section('content')
    <div class="mb-6 flex flex-wrap gap-2">
        <a href="{{ route('admin.custom-orders.index') }}" class="chip {{ !$current ? 'bg-berry-500 text-white' : 'bg-white text-ink/60 ring-1 ring-berry-100' }}">All</a>
        @foreach ($statuses as $status)
            <a href="{{ route('admin.custom-orders.index', ['status' => $status]) }}"
               class="chip {{ $current === $status ? 'bg-berry-500 text-white' : 'bg-white text-ink/60 ring-1 ring-berry-100' }}">{{ ucfirst($status) }}</a>
        @endforeach
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-berry-50 text-xs uppercase tracking-wide text-ink/50">
                    <tr>
                        <th class="px-5 py-4">Name</th>
                        <th class="px-5 py-4">Event</th>
                        <th class="px-5 py-4">Date</th>
                        <th class="px-5 py-4">Guests/Bags</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Received</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-berry-50">
                    @forelse ($requests as $req)
                        <tr class="cursor-pointer hover:bg-berry-50/50" onclick="window.location='{{ route('admin.custom-orders.show', $req) }}'">
                            <td class="px-5 py-4">
                                <span class="block font-semibold text-ink">{{ $req->name }}</span>
                                <span class="block text-xs text-ink/50">{{ $req->email }}</span>
                            </td>
                            <td class="px-5 py-4 text-ink/60">{{ $req->event_type ?: '—' }}</td>
                            <td class="px-5 py-4 text-ink/60">{{ $req->event_date?->format('M j, Y') ?? '—' }}</td>
                            <td class="px-5 py-4 text-ink/60">{{ $req->guest_count ?: '—' }}</td>
                            <td class="px-5 py-4"><x-status-badge :status="$req->status" /></td>
                            <td class="px-5 py-4 text-ink/50">{{ $req->created_at->format('M j, Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-ink/40">No requests found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $requests->links() }}</div>
@endsection
