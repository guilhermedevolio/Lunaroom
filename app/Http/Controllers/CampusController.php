<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusController extends Controller
{
    public function viewCampus(): View
    {
        return view('campus.index');
    }
}
