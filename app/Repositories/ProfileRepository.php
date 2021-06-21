<?php


namespace App\Repositories;


use App\Enums\ProfileEnum;
use App\Http\Requests\CreatePublicProfileRequest;
use App\Models\Profile\Profile;
use App\Traits\UploaderFileTrait;
use Illuminate\Support\Facades\Auth;

class ProfileRepository
{
    protected $model;

    use UploaderFileTrait;

    public function __construct(Profile $model)
    {
        $this->model = $model;
    }


    public function createPublicProfile()
    {
        return \Auth::user()->profile()->create();
    }

    public function updatePublicProfile(array $payload): bool
    {
        if (isset($payload["active"])) {
            $payload["active"] = ProfileEnum::PROFILE_ACTIVE;
        } else {
            $payload["active"] = ProfileEnum::PROFILE_INACTIVE;
        }

        if (isset($payload["image"])) {

            if (Auth::user()->profile->image) {
                $this->delete('profiles_images/', Auth::user()->profile->image);
            }

            $filename = $this->upload('profiles_images/', $payload["image"]);

            $payload["image"] = $filename;
        }

        return Auth::user()->profile()->update($payload);
    }
}
