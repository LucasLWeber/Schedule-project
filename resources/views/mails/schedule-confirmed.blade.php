<x-mail::message>
    # Schedule confirmed

    @php
        $scheduleTime = new DateTime($schedule->schedule_time);
    @endphp

    Your schedule was confirmed on the date {{ $scheduleTime->format('Y-m-d') }} at {{ $scheduleTime->format('H:i') }}.

    See you soon! 😀

</x-mail::message>
