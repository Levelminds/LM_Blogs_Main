@php
    $brandName = config('app.name', 'LevelMinds');
    if ($brandName === 'Laravel') {
        $brandName = 'LevelMinds';
    }
    $currentYear = now()->year;
    $defaultFooter = '© ' . $currentYear . ' ' . $brandName;
    $slotContent = trim((string) $slot);
    $laravelFooter = '© ' . $currentYear . ' Laravel. All rights reserved.';
    $brandFooter = $defaultFooter . '. All rights reserved.';
@endphp
<tr>
<td>
    <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="content-cell" align="center">
                @if ($slot->isEmpty() || $slotContent === '' || $slotContent === $laravelFooter || $slotContent === $brandFooter)
                    <p style="margin-top: 0; color: #9ca3af; font-size: 12px; line-height: 1.5;">{{ $defaultFooter }}</p>
                @else
                    {!! Illuminate\Mail\Markdown::parse($slot) !!}
                @endif
            </td>
        </tr>
    </table>
</td>
</tr>
