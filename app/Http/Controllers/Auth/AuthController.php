<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\PostUserRequest;
use App\Repositories\AuthRepository;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected AuthRepository $repository;

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
            return $this->unauthorized(['msg' => $ex->getMessage()]);
        }
    }

    public function postUser(PostUserRequest $request): JsonResponse
    {
        $payload = $request->validated();

        try {
            $response = $this->repository->registerUser($payload);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
            return response()->json('Erro interno no servidor');
        }

    }

    public function logout(): Redirector|Application|RedirectResponse
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
