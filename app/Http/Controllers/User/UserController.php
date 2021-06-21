<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Course;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepository $repository;

    use ResponseTrait;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUsers(): View
    {
        $users = $this->repository->getUsers();

        return view('admin.users', compact('users'));
    }

    public function getUserById(int $user): View
    {
        $courses = Course::all();
        $user = $this->repository->getUserById($user);

        return view('admin.update-user', compact('user', 'courses'));
    }

    public function putUser(UpdateUserRequest $request, int $userId): JsonResponse
    {
        $payload = $request->validated();

        $user = $this->repository->updateUser($userId, $payload);

        return $this->success();
    }

    public function deleteUser(int $userId): JsonResponse
    {
        if ($this->checkIfIsMe($userId)) {
            return $this->error(['msg' => 'Você não pode se excluir']);
        }

        $user = $this->repository->deleteUser($userId);
        return $this->success();
    }

    public function checkIfIsMe(int $id): bool
    {
        if (\Auth::user()->id == $id) {
            return true;
        }

        return false;
    }


}
