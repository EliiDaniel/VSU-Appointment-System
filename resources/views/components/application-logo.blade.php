@props([
    'name',
    'show' => false,
    'maxWidth' => 'md'
])

@php
$maxWidth = [
    'xs' => 'h-16',
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp
    <img src="{{ asset('images/VSUAS LOGO.png') }}" alt="Example Image" class="{{ $maxWidth }} dark:invert">
@if (!auth()->user())
    <div class="absolute right-0 bottom-0">
        <img src="{{ asset('images/VSU LOGO.png') }}" alt="Example Image" width="650">
    </div>
@endif