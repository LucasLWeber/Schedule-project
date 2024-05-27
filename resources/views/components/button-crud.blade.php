<button
    @class(['mt-8 py-2 px-4 rounded-md', $backgroundClass])
    type="button"
    wire:click="{{ $handle }}"
    x-on:click="
        notification('Success', 'Your schedule was successfully {{ $handle }}d. We sent an email to you remember it.', '{{ $color }}')
        open{{$text}} = false
        "
>
    {{ $text }}
</button>
