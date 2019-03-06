<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function checkUser($email,$password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
        }
        else
        {
            $response = array();
            $response['code'] = '0';
            $response['message'] = 'Invalid email or password';
            echo json_encode($response);
            die();
        }

    }
    public function userExists($email)
    {
        if ( User::where('email',$email)->count() == 0 )
        {
            return true;
        }
        else
        {
            $response = array();
            $response['code'] = '0';
            $response['message'] = 'Email or fb id is already exists';
            echo json_encode($response);
            die();
        }

    }




}
