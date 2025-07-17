@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full p-2.5 bg-white border-[1px] border-[color:var(--darkgrey)] rounded-[10px] text-[color:var(--black)] transition-all duration-[0.3s] ease-[ease] focus:outline-none focus:border-[color:var(--green)]']) }}>
