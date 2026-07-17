@extends('admin.layout')

@section('title', 'Early List')
@section('heading', 'Early Field & Pantry List')

@section('actions')
    <a href="{{ route('admin.early-list.export') }}" class="btn-primary !py-2.5 text-sm">⬇ Export CSV</a>
@endsection

@section('content')
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-berry-50 text-xs uppercase tracking-wide text-ink/50">
                    <tr>
                        <th class="px-5 py-4">Name</th>
                        <th class="px-5 py-4">Contact</th>
                        <th class="px-5 py-4">Interests</th>
                        <th class="px-5 py-4">Source</th>
                        <th class="px-5 py-4">Joined</th>
                        <th class="px-5 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-berry-50">
                    @forelse ($signups as $s)
                        <tr class="hover:bg-berry-50/50">
                            <td class="px-5 py-4 font-semibold text-ink">{{ $s->name }}</td>
                            <td class="px-5 py-4">
                                <a href="mailto:{{ $s->email }}" class="block text-berry-600 hover:underline">{{ $s->email }}</a>
                                @if ($s->phone)<span class="block text-xs text-ink/50">{{ $s->phone }}</span>@endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($s->interests ?? [] as $interest)
                                        <span class="chip bg-grape-100 text-grape-600">{{ $options[$interest] ?? $interest }}</span>
                                    @empty
                                        <span class="text-ink/40">—</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-5 py-4 text-ink/60">{{ $s->source ?: '—' }}</td>
                            <td class="px-5 py-4 text-ink/50">{{ $s->created_at->format('M j, Y') }}</td>
                            <td class="px-5 py-4 text-right">
                                <form action="{{ route('admin.early-list.destroy', $s) }}" method="POST" onsubmit="return confirm('Remove this signup?')">
                                    @csrf @method('DELETE')
                                    <button class="rounded-full bg-ink/5 px-3 py-1.5 text-xs font-bold text-ink/50 hover:bg-berry-100 hover:text-berry-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-ink/40">No signups yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $signups->links() }}</div>
@endsection
