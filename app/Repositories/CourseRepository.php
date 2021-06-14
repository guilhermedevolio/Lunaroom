<?php


namespace App\Repositories;


use App\Models\Course;
use App\Traits\UploaderFileTrait;
use Illuminate\Support\Facades\Storage;

class CourseRepository
{
    use UploaderFileTrait;

    protected $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    public function postCourse(array $payload)
    {
        $fileName = $this->upload('courses', $payload["image"]);
        $payload["image"] = $fileName;

        return $this->model->create($payload);
    }

    public function getCourses()
    {
        return $this->model->get();
    }

    public function getCourse(int $id)
    {
        return $this->model->with('modules')->findOrFail($id);
    }

    public function deleteCourse(int $courseId)
    {
        $course = $this->model->findOrFail($courseId);

        $this->delete('courses/', $course->image);

        return $course->delete();
    }
}
