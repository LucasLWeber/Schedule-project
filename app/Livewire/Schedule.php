<?php

namespace App\Livewire;

use Livewire\Component;

class Schedule extends Component
{
    public int $lastDay;
    public int $day;
    public int $month;

    public function updatedMonth(): void
    {
       $this->day = $this->month === (int) date('m') ? (int) date('d') : 1;
       $this->lastDay = (int) date('t', strtotime("2024-$this->month"));
    }

    public function getMonth(){
        $this->updatedMonth();
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
