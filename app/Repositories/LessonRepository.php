<?php


namespace App\Repositories;


use App\Models\Lesson;

class LessonRepository
{

    protected $model;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }

    public function createLesson(array $payload)
    {
        return $this->model->create($payload);
    }
}
