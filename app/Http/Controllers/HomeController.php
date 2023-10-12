<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        // available() et recent() sont des scopes définis dans le model Property
        $properties=Property::with('pictures')->available(true)->recent()->limit(4)->get();

        return view('home',[
            'properties' => $properties
        ]);
    }
}
