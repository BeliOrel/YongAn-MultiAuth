<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Employer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'job_title'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // we overwrite this to send email to employers instead of users
    // we make new notification 'AdminResetPasswordNotification'
    // which is then accessable in folder Notifications
    //>php artisan make:notification AdminResetPasswordNotification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));   
    }
}
