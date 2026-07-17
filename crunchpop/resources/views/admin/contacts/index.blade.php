@extends('admin.layout')

@section('title', 'Messages')
@section('heading', 'Contact Messages')

@section('content')
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-berry-50 text-xs uppercase tracking-wide text-ink/50">
                    <tr>
                        <th class="px-5 py-4">From</th>
                        <th class="px-5 py-4">Subject</th>
                        <th class="px-5 py-4">Received</th>
                        <th class="px-5 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-berry-50">
                    @forelse ($messages as $msg)
                        <tr class="cursor-pointer hover:bg-berry-50/50 {{ $msg->is_read ? '' : 'bg-tangerine-50/40' }}" onclick="window.location='{{ route('admin.contacts.show', $msg) }}'">
                            <td class="px-5 py-4">
                                <span class="flex items-center gap-2">
                                    @unless ($msg->is_read)<span class="h-2 w-2 shrink-0 rounded-full bg-berry-500"></span>@endunless
                                    <span>
                                        <span class="block font-semibold text-ink">{{ $msg->name }}</span>
                                        <span class="block text-xs text-ink/50">{{ $msg->email }}</span>
                                    </span>
                                </span>
                            </td>
                            <td class="px-5 py-4 text-ink/70">{{ $msg->subject ?: '(no subject)' }}</td>
                            <td class="px-5 py-4 text-ink/50">{{ $msg->created_at->format('M j, Y') }}</td>
                            <td class="px-5 py-4 text-right text-berry-600">View →</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-10 text-center text-ink/40">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $messages->links() }}</div>
@endsection
