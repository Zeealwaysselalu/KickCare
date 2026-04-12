<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full bg-[#eb7f30] text-white rounded p-3 text-[13px] font-bold tracking-[2px] uppercase mt-1 transition-colors duration-200 hover:bg-[#d4730f] active:bg-[#bf650d] rounded-[47px]']) }}>
    {{ $slot }}
</button>