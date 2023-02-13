<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailService extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'employee_id',
        'first_name',
        'vacation',
        'transfer',
        'promotion',
        'complaining',
        'resignation',
        'subject',
        'details'
        
    ];
    public $timestamps=false;
}
