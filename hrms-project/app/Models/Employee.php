<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Employee extends Authenticatable  
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard='employee_api';
    protected $fillable = [
        "first_name",
        "middle_name",
        "last_name",
        "email",
        "password",
        "university",
        "phone_number",
        "birth_day",
        "city",
        "branch",
        "department",
        "job_title",
        "date_of_job",
        "basic_salary",
        "bank_account_name",
        "bank_account_details",
        "certifcates",
        "branch_id",
        "department_id"
    ];
    public $timestamps=false;
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
