<?php


namespace App\Repositories;


use App\Mail\GreetingsRegister;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthRepository
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function authenticate(array $credentials): bool
    {
       if(!Auth::attempt($credentials)){
           throw new AuthorizationException('Wrong Credentials', '401');
       }

       return true;
    }

    public function registerUser(array $payload)
    {
        $register = $this->model->create($payload);

        Mail::to($payload["email"])->send(new GreetingsRegister($payload["name"]));

        return $register;
    }
}
