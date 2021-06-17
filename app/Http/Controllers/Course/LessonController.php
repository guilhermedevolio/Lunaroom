<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Repositories\LessonRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class LessonController extends Controller
{
    private LessonRepository $repository;

    use ResponseTrait;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postLesson(PostLessonRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $this->repository->createLesson($payload);

        return $this->success();
    }

    public function putLesson(UpdateLessonRequest $request, $lessonId): JsonResponse
    {
        $payload = $request->validated();

        $this->repository->updateLesson($payload, $lessonId);

        return $this->success();
    }

    public function deleteLesson($lessonId)
    {
        $this->repository->deleteLessson($lessonId);

        return redirect(route('courses'));
    }

    public function getLesson($lessonId)
    {
        $lesson = $this->repository->getLesson($lessonId);
        return view('admin.course.lesson.edit', compact('lesson'));
    }
}
