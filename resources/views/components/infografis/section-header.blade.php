@props([
    'title',
    'color' => 'emerald',
    'icon' => null,
    'number' => null,
    'subtitle' => null,
])

@php
$colors = [
    'emerald' => ['badge' => 'bg-emerald-600', 'border' => 'border-emerald-500', 'icon' => 'text-emerald-600'],
    'sky'     => ['badge' => 'bg-sky-600',     'border' => 'border-sky-500',     'icon' => 'text-sky-600'],
    'teal'    => ['badge' => 'bg-teal-600',    'border' => 'border-teal-500',    'icon' => 'text-teal-600'],
    'rose'    => ['badge' => 'bg-rose-600',    'border' => 'border-rose-500',    'icon' => 'text-rose-600'],
    'amber'   => ['badge' => 'bg-amber-500',   'border' => 'border-amber-500',   'icon' => 'text-amber-600'],
    'indigo'  => ['badge' => 'bg-indigo-600',  'border' => 'border-indigo-500',  'icon' => 'text-indigo-600'],
    'slate'   => ['badge' => 'bg-slate-700',   'border' => 'border-slate-400',   'icon' => 'text-slate-600'],
];
$c = $colors[$color] ?? $colors['emerald'];
@endphp

<div>
    <div class="flex items-center gap-3 border-b-2 {{ $c['border'] }} pb-2">
        @isset($number)
            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full {{ $c['badge'] }} text-sm font-bold text-white">{{ $number }}</span>
        @endisset
        @isset($icon)
            <i class="{{ $icon }} {{ $c['icon'] }} text-lg" aria-hidden="true"></i>
        @endisset
        <h3 class="text-base font-bold text-gray-900 sm:text-lg">{{ $title }}</h3>
    </div>
    @isset($subtitle)
        <p class="mt-1.5 text-sm text-gray-500">{{ $subtitle }}</p>
    @endisset
</div>
