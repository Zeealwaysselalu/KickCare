@props(['disabled' => false])

<div class="relative">    
    <input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full py-[10px] pl-[12px] pr-[36px] border border-[#ccc] rounded bg-white text-[11px] tracking-[0.8px] text-[#555] outline-none focus:outline-none rounded-[10px]']) }}>
</div>
