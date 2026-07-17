@props(['status'])
@php
    $map = [
        'pending'    => 'bg-tangerine-100 text-tangerine-600',
        'paid'       => 'bg-lime-100 text-lime-500',
        'processing' => 'bg-skypop-100 text-skypop-500',
        'completed'  => 'bg-lime-100 text-lime-500',
        'cancelled'  => 'bg-berry-100 text-berry-600',
        'new'        => 'bg-tangerine-100 text-tangerine-600',
        'contacted'  => 'bg-skypop-100 text-skypop-500',
        'quoted'     => 'bg-grape-100 text-grape-600',
        'closed'     => 'bg-ink/10 text-ink/50',
    ];
    $class = $map[$status] ?? 'bg-ink/10 text-ink/50';
@endphp
<span {{ $attributes->merge(['class' => "chip $class"]) }}>{{ ucfirst($status) }}</span>
