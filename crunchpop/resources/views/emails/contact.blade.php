<x-emails.layout heading="New contact message" accent="#04b0dc">
    <p style="margin:0 0 16px;">You received a new message through the contact form.</p>
    <div style="background:#ecfbff;border-radius:14px;padding:16px;">
        <table style="width:100%;border-collapse:collapse;">
            <x-emails.partials.row label="Name" :value="$msg->name" />
            <x-emails.partials.row label="Email" :value="$msg->email" />
            <x-emails.partials.row label="Phone" :value="$msg->phone" />
            <x-emails.partials.row label="Subject" :value="$msg->subject" />
        </table>
    </div>
    <p style="margin:16px 0 6px;font-weight:700;color:#9b8fa3;font-size:13px;">Message</p>
    <p style="margin:0;white-space:pre-line;font-size:14px;">{{ $msg->message }}</p>
</x-emails.layout>
