<?php

namespace App\Actions;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleCrudAction
{

    public static function save(int $month, int $day, int $hour): void
    {
        !Auth::user() ? redirect('/login') : null;

        $userId = Auth::id();
        $scheduleTime = Carbon::create(2024, $month, $day, $hour, 0, 0);
        $status = true;

        try{
            Schedule::create([
                'user_id' => $userId,
                'schedule_time' => $scheduleTime,
                'status' => $status,
            ]);
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

    public static function delete(int $month, int $day, int $hour): void
    {
        $scheduleTime = Carbon::create(2024, $month, $day, $hour, 0, 0);
        $userId = Auth::id();

        $data = Schedule::where('user_id', $userId)->where('schedule_time', $scheduleTime)->first()->delete();
        dd($data);
    }

}
