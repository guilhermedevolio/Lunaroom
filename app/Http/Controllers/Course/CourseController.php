<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCourseToUserRequest;
use App\Http\Requests\BuyCourseRequest;
use App\Http\Requests\DeleteUserCourseRequest;
use App\Http\Requests\PostCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\User;
use App\Models\UserCourse;
use App\Repositories\CourseRepository;
use App\Traits\ResponseTrait;
use Auth;
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

    public function postCourse(PostCourseRequest $request): RedirectResponse
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


    public function putCourse(UpdateCourseRequest $request, int $courseId): RedirectResponse
    {
        $payload = $request->validated();

        $this->repository->putCourse($payload, $courseId);

        return redirect()->back();
    }


    public function deleteCourse(int $courseId)
    {
        $this->repository->deleteCourse($courseId);

        return redirect(route('courses'));
    }

    public function getMyCourses(): View
    {
        $courses = $this->getCoursesByUserId(Auth::user()->id);
        return view('campus.courses.my-courses', compact('courses'));
    }

    public function getCourseWebsite($courseId): View
    {
        $course = $this->repository->getCourse($courseId);

        if (!$this->checkUserHaveCourse($courseId, Auth::user()->id)) {
            return view('campus.courses.buy', compact('course'));
        }

        return view('campus.courses.course', compact('course'));
    }

    public function checkUserHaveCourse($courseId, $userId)
    {
        return UserCourse::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();
    }

    public function getCoursesByUserId(int $userId)
    {
        return User::where('id', $userId)->with('courses')->first();
    }

    public function addCourseUser(AddCourseToUserRequest $request): JsonResponse
    {
        $payload = $request->validated();

        try {
            $this->repository->addCourseToUser($payload);
            return $this->success();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 200);
        }

    }

    public function removeCourseUser(DeleteUserCourseRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $this->repository->deleteCourseUser($payload);

        return $this->success();
    }




}
