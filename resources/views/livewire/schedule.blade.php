<div class="flex flex-col items-center justify-center mt-4">
    <div class="mt-4 flex flex-row gap-6" >
        <div class="flex flex-col items-center">
            <label class="mb-1" for="month">Choose a month:</label>
            <select wire:model.live="selectedMonth" class="w-16">
                @for($i = (int) date('m'); $i <= 12; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="flex flex-col items-center">
            <label class="mb-1" for="day">Choose a day:</label>
            <select wire:model.live="selectedDay" class="w-16" id="day">
                @for($i = $firstDay; $i <= $lastDay; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <ol class="mt-6 grid lg:grid-cols-5 grid-cols-2 gap-2 py-2 px-4 items-center self-center">
        @for($hour = 8; $hour < 19; $hour++)
            @if($hour === 12)
                @continue
            @endif

            @php
                $isReserved = false;
                foreach($scheduleReserved as $data){
                    if($hour === (int) date('H', strtotime($data['schedule_time']))){
                        $isReserved = true;
                        break;
                    }
                }
            @endphp
            @if($isReserved && \Illuminate\Support\Facades\Auth::id() === $data['user_id'])
               <button
                    wire:click="getScheduleHour({{ $hour }})"
                    class="cursor-pointer p-2 bg-red-300 focus:bg-red-400 flex flex-col justify-center items-center rounded-md"
               >{{ $hour }}:00
               </button>
            @elseif($isReserved && \Illuminate\Support\Facades\Auth::id() !== $data['user_id'])
               <button
                    disabled
                    class="cursor-not-allowed p-2 bg-red-400 focus:bg-red-400 flex flex-col justify-center items-center rounded-md"
               >{{ $hour }}:00
               </button>
            @else
                <button
                    wire:click="getScheduleHour({{ $hour }})"
                    class="cursor-pointer p-2 bg-gray-100 hover:bg-gray-200 focus:bg-green-200 flex flex-col justify-center items-center rounded-md"
                >{{ $hour }}:00
                </button>
            @endif
        @endfor
    </ol>

    <div>
        <x-button-crud
            text="Save"
            handle="save"
        />

        <x-button-crud
            text="Delete"
            handle="delete"
        />
    </div>
</div>
