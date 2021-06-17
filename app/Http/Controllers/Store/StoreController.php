<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function getCourses()
    {
        $courses = Course::paginate(10);
        return view('campus.store.store', compact('courses'));
    }
}
