<?php


namespace App\Repositories;


use App\Mail\GreetingsRegister;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthRepository
{
    private User $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @throws AuthorizationException
     */
    public function authenticate(array $credentials): bool
    {
       if(!Auth::attempt($credentials)){
           throw new AuthorizationException('Wrong Credentials', '401');
       }

       return true;
    }

    public function registerUser(array $payload)
    {
        $user = $this->model->create($payload);

        $this->sendGreetingsRegisterEmail($user);

        return $user;
    }

    public function sendGreetingsRegisterEmail($user): void
    {
        Mail::to($user->email)->send(new GreetingsRegister($user));
    }
}
