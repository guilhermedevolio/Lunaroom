<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePublicProfileRequest;
use App\Repositories\ProfileRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected ProfileRepository $repository;

    use ResponseTrait;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewUserProfile(): View
    {
        return view('campus.profile.index');
    }

    public function viewConfigPublicProfile(): View
    {
        return view('campus.profile.config-public-profile');
    }

    public function createPublicProfile(Request $request): JsonResponse
    {
        $this->repository->createPublicProfile();

        return $this->success();
    }

    public function updatePublicProfile(UpdatePublicProfileRequest $request)
    {
        $payload = $request->validated();

        $this->repository->updatePublicProfile($payload);

        return redirect(route('config-public-profile'))
            ->with('message', 'Perfil Atualizado com sucesso');
    }


}
