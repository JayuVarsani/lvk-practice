<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Loader extends Component
{
    public $target;
    public function __construct($target)
    {
        $this->target=$target;
    }
    public function render(): View
    {
        return view('components.loader');
    }
}
