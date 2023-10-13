<?php

namespace App\View\Components;

use App\Models\Property;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Recent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // available() et recent() sont des scopes définis dans le model Property
        $properties=Property::with('pictures')->available(true)->recent()->limit(4)->get();
        return view('components.recent', [
            'properties' => $properties
        ]);
    }
}
