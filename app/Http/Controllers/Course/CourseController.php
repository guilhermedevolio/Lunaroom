<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCourseRequest;
use App\Http\Requests\PutCourseRequest;
use App\Repositories\CourseRepository;
use App\Traits\ResponseTrait;
use Illuminate\View\View;

class CourseController extends Controller
{
    use ResponseTrait;

    protected $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewAddCourse(): View
    {
        return view('admin.course.new');
    }

    public function getCourses(): View
    {
        $courses = $this->repository->getCourses();
        return view('admin.course.courses', compact('courses'));
    }

    public function postCourse(PostCourseRequest $request)
    {
        $payload = $request->validated();

        $this->repository->postCourse($payload);

        return redirect(route('courses'));
    }

    public function getCourse($courseId): View
    {
        $course = $this->repository->getCourse($courseId);
        return view('admin.course.edit', compact('course'));
    }


    public function putCourse(PutCourseRequest $request, int $courseId)
    {
        $payload = $request->validated();

        $this->repository->putCourse($payload, $courseId);

        return $this->success();
    }


    public function deleteCourse(int $courseId)
    {
        $response = $this->repository->deleteCourse($courseId);

        return redirect(route('courses'));
    }
}
