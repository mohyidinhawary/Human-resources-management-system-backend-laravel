<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;
    protected $fillable = [
        "employee_id",
        "first_name",
        "leave_type",
        "applied_on",
        "start_date",
        "end_date",
        "leave_reason"
        
    ];
    public $timestamps=false;
}
