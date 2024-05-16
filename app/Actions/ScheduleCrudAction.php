<?php

namespace App\Actions;

use App\Mail\ScheduleCanceledMail;
use App\Mail\ScheduleConfirmedMail;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ScheduleCrudAction
{

    public static function save(int $month, int $day, int $hour): void
    {
        if(!Auth::user()){
            redirect('/login');
            return;
        }


        $userId = Auth::id();
        $scheduleTime = Carbon::create(2024, $month, $day, $hour, 0, 0);
        $status = true;

        Schedule::create([
            'user_id' => $userId,
            'schedule_time' => $scheduleTime,
            'status' => $status,
        ]);

        $schedule = Schedule::where('user_id', $userId)->where('schedule_time', $scheduleTime)->first();

        Mail::to(Auth::user()->email)->send(new ScheduleConfirmedMail($schedule));

    }

    public static function delete(int $month, int $day, int $hour): void
    {
        if(!Auth::user()){
            redirect('/login');
            return;
        }

        $scheduleTime = Carbon::create(2024, $month, $day, $hour, 0, 0);
        $userId = Auth::id();

        $schedule = Schedule::where('user_id', $userId)->where('schedule_time', $scheduleTime)->first();
        Mail::to(Auth::user()->email)->send(new ScheduleCanceledMail($schedule));
        $schedule->delete();
    }

}
