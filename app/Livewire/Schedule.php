<?php

namespace App\Livewire;

use App\Actions\ScheduleCrudAction;
use Livewire\Component;

class Schedule extends Component
{

    public int $lastDay;
    public int $day;
    public int $month;
    public int $scheduleHour;

    public function updatedMonth(): void
    {
       $this->day = $this->month === (int) date('m') ? (int) date('d') : 1;
       $this->lastDay = (int) date('t', strtotime("2024-$this->month"));
    }

    public function getMonth(){
        $this->updatedMonth();
    }

    public function getScheduleHour(int $hour): int
    {
        return $this->scheduleHour = $hour;
    }

    public function save(): void
    {
        ScheduleCrudAction::save($this->month, $this->day, $this->scheduleHour);
    }

    public function delete(): void
    {
        ScheduleCrudAction::delete($this->month, $this->day, $this->scheduleHour);
    }
    public function mount()
    {
        $this->month = (int) date('m');
        $this->day = (int) date('d');
        $this->lastDay = (int) date('t', strtotime("2024-$this->month"));
    }

    public function render()
    {
        return view('livewire.schedule');
    }
}
