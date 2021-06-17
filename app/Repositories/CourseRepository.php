<?php


namespace App\Repositories;


use App\Models\Course;
use App\Traits\UploaderFileTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CourseRepository
{
    protected Course $model;

    use UploaderFileTrait;

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

    public function getCourses(): Collection|array
    {
        return $this->model->all();
    }

    public function getCourse($id): Model|Collection|Builder|array|null
    {
        return $this->model->with(['modules.lessons'])->findOrFail($id);
    }

    public function deleteCourse($courseId)
    {
        $course = $this->model->findOrFail($courseId);

        $this->delete('courses/', $course->image);

        return $course->delete();
    }

    public function putCourse($payload, $courseId)
    {
        $course = $this->model->findOrFail($courseId);

        if (isset($payload["image"])) {
            $this->delete('courses/', $course->image);
            $fileName = $this->upload('courses/', $payload["image"]);

            $payload["image"] = $fileName;
        }

        return $course->update($payload);
    }
}
