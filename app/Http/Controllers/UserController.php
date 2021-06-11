<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private $repository;

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
        $user = $this->repository->getUserById($user);

        return view('admin.update-user', compact('user'));
    }

    public function putUser(UpdateUserRequest $request, int $userId)
    {
        $payload = $request->validated();

        try {
           $user = $this->repository->updateUser($userId, $payload);
           return redirect(route('get-user', $userId));
        } catch (\Exception $e) {
            return $this->error(['msg' => $e->getMessage()]);
        }
    }
}
