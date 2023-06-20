<?php

namespace App\View\Components;

use App\Console\Kernel;
use Closure;
use DateInterval;
use DateTimeInterface;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class GenToolTimer extends Component
{
    public $expires;

    public function __construct()
    {
        app()->make(Kernel::class);
        $schedule = app()->make(Schedule::class);

        $tasks = collect($schedule->events());

        $matches = $tasks->filter(function ($item) {
            return Str::contains($item->command, 'gentool:fetch');
        });
        
        $this->expires = $matches->first()->nextRunDate();
    }

    public function days(): string
    {
        return sprintf('%02d', $this->difference()->d);
    }

    public function hours(): string
    {
        return sprintf('%02d', $this->difference()->h);
    }

    public function minutes(): string
    {
        return sprintf('%02d', $this->difference()->i);
    }

    public function seconds(): string
    {
        return sprintf('%02d', $this->difference()->s);
    }

    public function difference(): DateInterval
    {
        return $this->expires->diff(now());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gen-tool-timer');
    }
}
