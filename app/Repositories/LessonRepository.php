<?php


namespace App\Repositories;


use App\Models\Lesson;

class LessonRepository
{

    protected Lesson $model;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }

    public function createLesson(array $payload)
    {
        return $this->model->create($payload);
    }

    public function updateLesson(array $payload, $lessonId)
    {
        return $this->model->findOrFail($lessonId)
            ->update($payload);
    }

    public function deleteLesson($lessonId)
    {
        return $this->model->findOrFail($lessonId)->delete();
    }

    public function getLesson($lessonId)
    {
        return $this->model->findOrFail($lessonId);
    }

    public function getLessonWebsite($lessonId)
    {
       $lesson =  $this->model->findOrFail($lessonId);

       return $lesson;

    }

}
