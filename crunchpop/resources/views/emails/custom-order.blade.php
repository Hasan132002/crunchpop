<x-emails.layout heading="New custom order request" accent="#8c3dff">
    <p style="margin:0 0 16px;">A new custom order request came in from <strong>{{ $req->name }}</strong>.</p>
    <div style="background:#f6f2ff;border-radius:14px;padding:16px;">
        <table style="width:100%;border-collapse:collapse;">
            <x-emails.partials.row label="Name" :value="$req->name" />
            <x-emails.partials.row label="Email" :value="$req->email" />
            <x-emails.partials.row label="Phone" :value="$req->phone" />
            <x-emails.partials.row label="Organization" :value="$req->organization" />
            <x-emails.partials.row label="Event type" :value="$req->event_type" />
            <x-emails.partials.row label="Event date" :value="$req->event_date?->format('M j, Y')" />
            <x-emails.partials.row label="Guests / bags" :value="$req->guest_count" />
            <x-emails.partials.row label="Candy type" :value="$req->candy_type" />
            <x-emails.partials.row label="Bag size" :value="$req->bag_size" />
            <x-emails.partials.row label="Budget" :value="$req->budget_range" />
            <x-emails.partials.row label="Fulfillment" :value="$req->fulfillment_preference ? ucfirst($req->fulfillment_preference) : null" />
            <x-emails.partials.row label="Message" :value="$req->message" />
        </table>
    </div>
</x-emails.layout>
