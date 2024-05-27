<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonCrud extends Component
{

    public string $text;
    public string $handle;
    public string $color;

    public function __construct(string $text, string $handle, string $color)
    {
        $this->text = $text;
        $this->handle = $handle;
        $this->color = $color;
    }

    public function getBackgroundClass(): string
    {
        $backgroundClass = [
            'Delete' => 'bg-red-500 hover:bg-red-600',
            'Save' => 'bg-green-500 hover:bg-green-600',
        ];

        return $backgroundClass[$this->text];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-crud', ['backgroundClass' => $this->getBackgroundClass()]);
    }
}
