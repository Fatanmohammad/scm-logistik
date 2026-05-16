@props(['active'])

@php
$classes = ($active ?? false)
            ? 'px-4 py-2 text-[10px] font-black tracking-[0.2em] bg-indigo-600/10 text-indigo-400 rounded-xl border border-indigo-500/20 transition-all'
            : 'px-4 py-2 text-[10px] font-black tracking-[0.2em] text-slate-500 hover:text-slate-200 hover:bg-white/5 rounded-xl transition-all';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>