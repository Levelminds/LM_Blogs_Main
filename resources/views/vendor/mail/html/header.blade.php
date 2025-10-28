@props(['url'])

@php
    $brandName = config('app.name', 'LevelMinds');
    if ($brandName === 'Laravel') {
        $brandName = 'LevelMinds';
    }
    $shouldUseBrand = trim((string) $slot) === '' || trim((string) $slot) === 'Laravel';
    $href = $url ?? config('app.url');
@endphp
<tr>
<td class="header">
    <a href="{{ $href ?: '#' }}" style="display: inline-block; text-decoration: none;">
        @if ($shouldUseBrand)
            <span style="font-size: 20px; font-weight: 600; color: #111827; letter-spacing: 0.01em;">{{ $brandName }}</span>
        @else
            {{ $slot }}
        @endif
    </a>
</td>
</tr>
