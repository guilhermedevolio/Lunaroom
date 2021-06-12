<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\AuthRepository;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected $repository;

    use ResponseTrait;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewLogin(): View
    {
        return view('auth.login');
    }

    public function viewRegister(): View
    {
        return view('auth.register');
    }

    public function postAuthenticate(AuthLoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        try {
            $this->repository->authenticate($credentials);
            return $this->success();
        } catch (AuthorizationException $ex) {
            return $this->unauthorized();
        }
    }

    public function postUser(RegisterUserRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $response = $this->repository->registerUser($payload);
        return response()->json($response, 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
