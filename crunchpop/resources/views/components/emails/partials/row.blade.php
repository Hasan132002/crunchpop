@props(['label', 'value'])
@if(filled($value))
<tr>
    <td style="padding:6px 12px 6px 0;color:#9b8fa3;font-size:13px;font-weight:700;white-space:nowrap;vertical-align:top;">{{ $label }}</td>
    <td style="padding:6px 0;font-size:14px;color:#2b1d33;">{{ $value }}</td>
</tr>
@endif
