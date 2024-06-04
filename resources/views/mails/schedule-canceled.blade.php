<x-mail::message>
    # Schedule canceled

    @php
        $scheduleTime = new DateTime($schedule->schedule_time);
    @endphp

    Your schedule was canceled on the date {{ $scheduleTime->format('Y-m-d') }} at {{ $scheduleTime->format('H:i') }}.

    Please be sure to schedule a new available time.

    See you soon! 😀

</x-mail::message>

