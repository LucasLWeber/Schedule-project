<div
    x-data="{ openSave: false, openDelete: false }"
    class="flex flex-col items-center justify-center mt-4"
>
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

    <ol
        class="mt-6 grid lg:grid-cols-5 grid-cols-2 gap-2 py-2 px-4 items-center self-center"
    >
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
                    x-on:click="openDelete = true"
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
                    x-on:click="openSave = true"
                    wire:click="getScheduleHour({{ $hour }})"
                    class="cursor-pointer p-2 bg-gray-100 hover:bg-gray-200 focus:bg-green-200 flex flex-col justify-center items-center rounded-md"
                >{{ $hour }}:00
                </button>
            @endif
        @endfor
    </ol>

    <div
        x-show="openSave"
        class="relative mt-2 flex flex-col items-center justify-center space-y-4 bg-slate-100 py-4 px-6 rounded-lg shadow-md"
    >
        <span>Do you realy want to schedule this time?</span>
        <x-button-crud
            text="Save"
            handle="save"
            color="green"
        />
        <button
            class="absolute top-[-24px] right-[-8px] bg-slate-300 hover:bg-slate-400 w-6 h-6 rounded-full shadow-md"
            x-on:click="openSave = false"
        >
            X
        </button>
    </div>

    <div
        x-show="openDelete"
        class="relative mt-2 flex flex-col items-center justify-center space-y-4 bg-slate-100 py-4 px-6 rounded-lg shadow-md"
    >
        <span>Do you realy want to cancel this time?</span>
        <x-button-crud
            text="Delete"
            handle="delete"
            color="red"
        />
        <button
            class="absolute top-[-24px] right-[-8px] bg-slate-300 hover:bg-slate-400 w-6 h-6 rounded-full shadow-md"
            x-on:click="openDelete = false"
        >
            X
        </button>
    </div>

    <script>
        function notification(title, message, color){
                let content = document.createElement('div');
                content.classList.add('flex', 'flex-col', 'items-start', 'justify-center', 'lg:max-w-64', 'max-w-48', 'gap-1', 'bg-slate-50', 'py-2', 'px-4', 'rounded-md', 'border-2', `border-${color}-500`, 'absolute', 'top-[16px]', 'right-[16px]');

                let titleBg = document.createElement('div');
                titleBg.classList.add('flex', 'flex-row', 'space-x-4', 'items-center');

                let titleText = document.createElement('span');
                titleText.classList.add('font-bold', 'text-sm')
                titleText.textContent = title;

                let titleIcon = document.createElement('div');
                titleIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-${color}-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        `;

                let textMessage = document.createElement('p');
                textMessage.classList.add('text-xs')
                textMessage.innerText = message;

                titleBg.appendChild(titleIcon);
                titleBg.appendChild(titleText);

                content.appendChild(titleBg);
                content.appendChild(textMessage);

                document.body.appendChild(content);

                setTimeout(() => {
                    content.remove();
                }, 5000);
        }
    </script>
</div>
