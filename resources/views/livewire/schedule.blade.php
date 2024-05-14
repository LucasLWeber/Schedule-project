<div class="flex flex-col items-center justify-center mt-4">
    <div class="mt-4 flex flex-row gap-6" >
        <div class="flex flex-col items-center">
            <label class="mb-1" for="day">Choose a day:</label>
            <select class="w-16" id="day" wire:model="day">
                @for($day; $day <= $lastDay; $day++)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endfor
            </select>
        </div>

        <div class="flex flex-col items-center">
            <label class="mb-1" for="month">Choose a month:</label>
            <select class="w-16" id="day" wire:model="month">
                @for($i = (int) date('m'); $i <= 12; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <button
        type="button"
        value="Submit"
        class="border px-4 py-2 rounded mt-4 hover:bg-gray-50"
        wire:click="getMonth"
    >
        Submit
    </button>

    <ol class="mt-6 grid lg:grid-cols-5 grid-cols-2 gap-2 py-2 px-4 items-center self-center">
        @for($hour = 8; $hour < 19; $hour++)
            @if($hour !== 12)
                <button
                    class="cursor-pointer p-2 bg-gray-100 hover:bg-gray-200 focus:bg-green-500 flex flex-col justify-center items-center rounded-md"
                >{{ $hour }}:00
                </button>
            @endif
        @endfor
    </ol>

    <div>
        <button
            class="mt-8 bg-green-500 py-2 px-4 rounded-md hover:bg-green-600"
            type="button"
            value="Save"
            wire:click="save"
        >
            Save
        </button>

        <button
            class="mt-8 bg-blue-500 py-2 px-4 rounded-md hover:bg-blue-600"
            type="button"
            value="Edit"
            wire:click="edit"
        >
            Edit
        </button>

        <button
            class="mt-8 bg-red-500 py-2 px-4 rounded-md hover:bg-red-600"
            type="button"
            value="Exclude"
            wire:click="exclude"
        >
            Exclude
        </button>
    </div>

</div>
