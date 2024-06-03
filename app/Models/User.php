<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = array(
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'isadmin',
    );

    protected $hidden = array(
        'password'
    );

    protected $casts = array(
        'id' => 'string',
        'password' => 'hashed',
    );

    public static function getUserByUsername (string $user_username) {
        $user = self::where('username', $user_username)
        ->first();

        return $user;
    }

    public static function boot () {
        parent::boot();

        static::creating(function ($user) {
            $user->id = Str::uuid();
        });
    }
}
