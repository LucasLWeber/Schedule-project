<?php

namespace App\Livewire;

use App\Actions\GetScheduleAction;
use App\Actions\ScheduleCrudAction;
use Livewire\Component;

class Schedule extends Component
{

    public int $lastDay;
    public int $firstDay;
    public int $selectedDay;
    public int $selectedMonth;
    public int $selectedScheduleHour = 0;
    public array $scheduleReserved;



    public function getScheduleHour(int $hour): int
    {
        return $this->selectedScheduleHour = $hour;
    }

    public function save(): void
    {
        ScheduleCrudAction::save($this->selectedMonth, $this->selectedDay, $this->selectedScheduleHour);
        $this->updated();
        $this->selectedScheduleHour = 0;
    }

    public function delete(): void
    {
        ScheduleCrudAction::delete($this->selectedMonth, $this->selectedDay, $this->selectedScheduleHour);
        $this->updated();
        $this->selectedScheduleHour = 0;
    }

    public function mount()
    {
        $this->selectedMonth = (int) date('m');
        $this->selectedDay = (int) date('d');
        $this->firstDay = $this->selectedDay;
        $this->lastDay = (int) date('t', strtotime("2024-". date('m')));
        $this->scheduleReserved = GetScheduleAction::handle($this->selectedMonth, $this->selectedDay);
    }

    public function updated()
    {
        $this->scheduleReserved = GetScheduleAction::handle($this->selectedMonth, $this->selectedDay);
    }


    public function updatedSelectedMonth(): void
    {
        $this->firstDay = $this->selectedMonth === (int) date('m') ? (int) date('d') : 1;
        $this->selectedDay = $this->firstDay;
        $this->lastDay = (int) date('t', strtotime("2024-$this->selectedMonth"));
        $this->scheduleReserved = GetScheduleAction::handle($this->selectedMonth, $this->selectedDay);
    }

    public function updatedSelectedDay(): void
    {
        $this->scheduleReserved = GetScheduleAction::handle($this->selectedMonth, $this->selectedDay);
    }

    public function render()
    {
        return view('livewire.schedule');
    }
}
