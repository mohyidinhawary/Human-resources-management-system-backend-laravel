<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $fillable = [
        "employee_id",
        "first_name",
        
        "email",
        
        "branch",
        "department",
        "job_title",
       
        
    ];
    public $timestamps=false;
}
