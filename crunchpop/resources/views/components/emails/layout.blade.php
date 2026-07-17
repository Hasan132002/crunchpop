@props(['heading' => 'CrunchPop Candy', 'accent' => '#ff2d7e'])
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body style="margin:0;background:#fffaf3;font-family:'Segoe UI',Arial,sans-serif;color:#2b1d33;">
    <div style="max-width:600px;margin:0 auto;padding:24px;">
        <div style="background:{{ $accent }};border-radius:20px 20px 0 0;padding:28px 32px;color:#fff;">
            <div style="font-size:22px;font-weight:800;">🍬 CrunchPop Candy</div>
            <div style="font-size:12px;letter-spacing:2px;text-transform:uppercase;opacity:.85;">Field &amp; Pantry LLC</div>
        </div>
        <div style="background:#fff;border-radius:0 0 20px 20px;padding:32px;box-shadow:0 10px 40px -15px rgba(43,29,51,.25);">
            <h1 style="margin:0 0 16px;font-size:20px;">{{ $heading }}</h1>
            {{ $slot }}
        </div>
        <p style="text-align:center;color:#9b8fa3;font-size:12px;margin-top:20px;">
            Candy today. Prepared families tomorrow.
        </p>
    </div>
</body>
</html>
