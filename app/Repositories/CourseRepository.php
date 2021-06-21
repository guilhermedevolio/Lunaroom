<?php


namespace App\Repositories;


use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use App\Traits\UploaderFileTrait;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

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

    public function deleteCourse($courseId): JsonResponse
    {
        $course = $this->model->findOrFail($courseId);

        $this->delete('courses/', $course->image);

        return $course->delete();
    }

    public function putCourse($payload, $courseId): bool
    {

        $course = $this->model->findOrFail($courseId);

        if (isset($payload["image"])) {

            // Delete Old File
            $this->delete('courses/', $course->image);

            // Update New File
            $fileName = $this->upload('courses/', $payload["image"]);

            $payload["image"] = $fileName;
        }

        return $course->update($payload);
    }

    /**
     * @throws Exception
     */
    public function addCourseToUser(array $payload)
    {
        $user = User::findOrFail($payload["user_id"]);
        if ($this->checkUserHaveCourse($payload["course_id"], $payload["user_id"])) {
            throw new Exception('User already owns the course', '302');
        }

        return $user->courses()->attach(['course_id' => $payload["course_id"]]);
    }

    public function checkUserHaveCourse(int $courseId, int $userId)
    {
        return UserCourse::where(['user_id' => $userId])->where(['course_id' => $courseId])->first();
    }

    public function removeCourseUser(array $payload)
    {
        return UserCourse::where('user_id', $payload["user_id"])
            ->where('course_id', $payload["course_id"])
            ->first()
            ->delete();
    }


}
