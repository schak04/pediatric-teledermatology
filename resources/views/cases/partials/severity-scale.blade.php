@php
    $value = $value ?? 0;
    $labels = ['', 'Mild', 'Mild-Mod', 'Moderate', 'Mod-Severe', 'Severe'];
@endphp
<div class="severity">
    @for($i = 1; $i <= 5; $i++)
    <div class="severity__dot {{ $value >= $i ? 'active-' . $value : '' }}" style="cursor:default"></div>
    @endfor
    @if($value)
    <span class="severity__label">{{ $labels[$value] ?? '' }}</span>
    @endif
</div>
