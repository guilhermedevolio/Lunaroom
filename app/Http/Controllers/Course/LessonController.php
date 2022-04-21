<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Repositories\LessonRepository;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

    public function putLesson(UpdateLessonRequest $request, int $lessonId): JsonResponse
    {
        $payload = $request->validated();

        $this->repository->updateLesson($payload, $lessonId);

        return $this->success();
    }

    public function deleteLesson(int $lessonId): RedirectResponse
    {
        $this->repository->deleteLesson($lessonId);

        return redirect(route('courses'));
    }

    public function getLesson(int $lessonId): View
    {
        $lesson = $this->repository->getLesson($lessonId);
        return view('admin.course.lesson.edit', compact('lesson'));
    }

    public function getLessonByid(int $lessonId): JsonResponse
    {
        $lesson = $this->repository->getLessonWebsite($lessonId);

        if($lesson["init_date"] > Carbon::now()){
            $date = date('d/m/Y', strtotime($lesson["init_date"]));
            return response()->json(['message' => "Noo! Essa aula estará disponivel no dia $date"], 422);
        }
        return response()->json($lesson);
    }
}
