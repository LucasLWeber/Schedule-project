<button
    @class(['mt-8 py-2 px-4 rounded-md', $getBackgroundClass])
    type="button"
    wire:click="{{ $handle }}"
>
    {{ $text }}
</button>
