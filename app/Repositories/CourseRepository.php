<?php


namespace App\Repositories;


use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use App\Notifications\AdminAddCourseToUser;
use App\Traits\UploaderFileTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseRepository
{
    protected Course $model;

    use UploaderFileTrait;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    public function getCourses(): Collection|array
    {
        return $this->model->all();
    }

    public function getCourseById($id)
    {
        return $this->model->find($id);
    }

    public function getCourse($id): Model|Collection|Builder|array|null
    {
        return $this->model->with(['modules.lessons', 'students.user'])->findOrFail($id);
    }


    public function postCourse(array $payload)
    {
        $fileName = $this->upload('courses', $payload["image"]);
        $payload["image"] = $fileName;

        return $this->model->create($payload);
    }

    public function deleteCourse($courseId): bool
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

            // Upload New File
            $fileName = $this->upload('courses/', $payload["image"]);

            $payload["image"] = $fileName;
        }

        return $course->update($payload);
    }


    public function addCourseToUser(array $payload)
    {
        $user = User::findOrFail($payload["user_id"]);

        if ($this->checkUserHaveCourse($payload["course_id"], $payload["user_id"])) {
            throw new Exception('User already owns the course', '302');
        }

        $course = $this->getCourseById($payload['course_id']);

        return DB::transaction(function () use ($payload, $user) {
            $user->courses()->attach($payload['course_id'], [
                'joined_at' => Carbon::now()]);
            $user->notify(new AdminAddCourseToUser($user, $payload["course_id"]));
        });

        return true;

    }

    public function checkUserHaveCourse(int $courseId, int $userId)
    {
        return UserCourse::where(['user_id' => $userId])->where(['course_id' => $courseId])->first();
    }

    public function deleteCourseUser(array $payload): JsonResponse
    {
        return UserCourse::where('user_id', $payload["user_id"])
            ->where('course_id', $payload["course_id"])
            ->first()
            ->delete();
    }

    public function joinCourse(array $payload): bool
    {
        $course = $this->getCourseById($payload['course_id']);

        return DB::transaction(function () use ($payload, $course) {
            $this->addCourseToUser(['course_id' => $payload['course_id'], 'user_id' => Auth::user()->id]);
            return true;
        });

    }

}
