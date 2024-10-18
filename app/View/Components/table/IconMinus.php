<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconMinus extends Component
{

     public function __construct(
     public string $action = '#',
     public string $method = 'DELETE',
     )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.icon-minus');
    }
}
