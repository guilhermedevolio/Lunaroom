<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLessonRequest;
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
}
