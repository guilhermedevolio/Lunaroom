<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCourseRequest;
use App\Repositories\CourseRepository;
use App\Traits\ResponseTrait;
use App\Traits\UploaderFileTrait;
use Illuminate\Http\JsonResponse;
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

    public function getCourse(int $courseId): View
    {
        $course = $this->repository->getCourse($courseId);
        return view('admin.course.edit', compact('course'));
    }

    public function deleteCourse(int $courseId)
    {
        $response = $this->repository->deleteCourse($courseId);

        return redirect(route('courses'));
    }
}
