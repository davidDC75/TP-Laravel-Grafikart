<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Weather;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }
}
