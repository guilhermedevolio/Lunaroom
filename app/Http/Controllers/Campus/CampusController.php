<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusController extends Controller
{
    public function viewCampus(): View
    {
        return view('campus.index');
    }
}
