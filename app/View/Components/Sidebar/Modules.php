<?php

declare(strict_types=1);

namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modules extends Component
{
    public array $modules = [];

    public function __construct()
    {
        $this->modules = config('modules');
    }

    public function render():  View|Closure|string
    {
        return view('components.sidebar.modules');
    }
}
