<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCourseRequest;
use App\Http\Requests\PutCourseRequest;
use App\Repositories\CourseRepository;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CourseController extends Controller
{
    use ResponseTrait;

    protected CourseRepository $repository;

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

    public function postCourse(PostCourseRequest $request): Redirector|Application|RedirectResponse
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


    public function putCourse(PutCourseRequest $request, int $courseId): JsonResponse
    {
        $payload = $request->validated();

        $this->repository->putCourse($payload, $courseId);

        return $this->success();
    }


    public function deleteCourse(int $courseId): Redirector|Application|RedirectResponse
    {
        $this->repository->deleteCourse($courseId);

        return redirect(route('courses'));
    }
}
