<x-emails.layout heading="New early-list signup" accent="#ff7a0a">
    <p style="margin:0 0 16px;"><strong>{{ $signup->name }}</strong> joined the early Field &amp; Pantry list.</p>
    <div style="background:#fff8ed;border-radius:14px;padding:16px;">
        <table style="width:100%;border-collapse:collapse;">
            <x-emails.partials.row label="Name" :value="$signup->name" />
            <x-emails.partials.row label="Email" :value="$signup->email" />
            <x-emails.partials.row label="Phone" :value="$signup->phone" />
            <x-emails.partials.row label="Source" :value="$signup->source" />
            <x-emails.partials.row
                label="Interests"
                :value="collect($signup->interests ?? [])->map(fn($i) => \App\Models\EarlyListSignup::INTEREST_OPTIONS[$i] ?? $i)->implode(', ')" />
        </table>
    </div>
</x-emails.layout>
