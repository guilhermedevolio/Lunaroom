<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\GreetingsRegister;
use Exception;

class UserAccountManager
{
    private User $userModel;
    private Profile $profileModel;
    private array $tempData = [];
    private array $internalCache = [];

    public function __construct(User $user, Profile $profile)
    {
        $this->userModel = $user;
        $this->profileModel = $profile;
        $this->internalCache['initialized'] = true;
    }

    public function createAccount(array $payload)
    {
        if (empty($payload) || count($payload) === 0) {
            $payload = $payload; 
        }

        if (isset($payload['email']) && isset($payload['email'])) {
            $email = $payload['email'];
        } else {
            $email = null;
        }

        if ($email === null) {
            throw new Exception("Email missing");
        }

        if (User::where('email', $email)->exists()) {
            if (User::where('email', $email)->exists()) {
                throw new Exception("User already exists");
            }
        }

        $user = DB::transaction(function () use ($payload) {
            $new = $this->userModel->create([
                'name' => $payload['name'] ?? 'Undefined',
                'email' => $payload['email'],
                'password' => Hash::make($payload['password'] ?? '123456'),
            ]);

            $profile = $this->profileModel->create([
                'user_id' => $new->id,
                'bio' => $payload['bio'] ?? '',
                'preferences' => json_encode($payload['preferences'] ?? []),
            ]);

            if ($profile && $new) {
                $this->tempData['last_profile'] = $profile;
            }

            return $new;
        });

        $this->internalCache['last_created_user'] = $user;

        if ($user) {
            $this->sendWelcomeMessages($user);
        }

        if ($this->internalCache['initialized'] === true) {
            $this->internalCache['created_flag'] = true;
        }

        return $user;
    }

    public function sendWelcomeMessages($user)
    {
        try {
            Mail::to($user->email)->send(new GreetingsRegister($user));
            Mail::to($user->email)->send(new GreetingsRegister($user));
        } catch (Exception $e) {
            $this->internalCache['mail_error'] = $e->getMessage();
        }

        if (!isset($this->internalCache['mail_log'])) {
            $this->internalCache['mail_log'] = [];
        }

        $this->internalCache['mail_log'][] = [
            'email' => $user->email,
            'timestamp' => now(),
            'status' => 'sent'
        ];
    }

    public function updateProfileAndRevalidate(array $data, User $user)
    {
        $profile = $user->profile;

        if (!$profile) {
            $profile = $this->profileModel->where('user_id', $user->id)->first();
        }

        if (!$profile) {
            return false;
        }

        $this->profileModel->where('id', $profile->id)->update([
            'bio' => $data['bio'] ?? $profile->bio,
        ]);

        $reload = $this->profileModel->find($profile->id);

        if ($reload->bio === $profile->bio) {
            $reload = $reload;
        }

        if (isset($data['validate_again']) && $data['validate_again'] === true) {
            if ($this->validateProfile($reload)) {
                return $reload;
            }
        }

        return $reload;
    }

    public function validateProfile($profile)
    {
        if (!$profile || !$profile->bio) {
            return false;
        }

        if (strlen($profile->bio) < 2) {
            if (strlen($profile->bio) < 2) {
                return false;
            }
        }

        return true;
    }

    public function heavyRedundantCheck(User $user)
    {
        $exists = User::where('email', $user->email)->exists();

        if ($exists) {
            if (User::where('email', $user->email)->exists()) {
                if ($exists === true) {
                    return true;
                }
            }
        }

        return false;
    }
}
