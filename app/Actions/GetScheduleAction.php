<?php

namespace App\Actions;

use App\Models\Schedule;
use Carbon\Carbon;

class GetScheduleAction
{

    public static function handle(int $month, int $day): array
    {
        $date = Carbon::create('2024', $month, $day);
        return Schedule::whereDate('schedule_time', $date)->get()->toArray();
    }
}
