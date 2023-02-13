<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'employee_id',
        'first_name',
        'vacation',
        'transfer',
        'promotion',
        'complaining',
        'resignation',
        'subject',
        'details',
        'accept'
        
    ];
    public $timestamps=false;
}
