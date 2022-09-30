<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = ['date_of_birth'];

    protected $fillable = [
        'first_name',
        'sure_name',
        'email',
        'user_role',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'address',
        'graduation_year',
        'phone_number',
        'parent_phone_number',
        'formal_education',
        'study_program',
        'class',
        'semester',
        'learning_program',
        'program_institution',
        'photo',
        'proof_of_payment',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
