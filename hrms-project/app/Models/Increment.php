<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Increment extends Model
{
    use HasFactory;
    protected $fillable = [
        "employee_id",
        "increment_date",
        "award",
        "over_time",
        "increment_amount",
        "increment_details"
        
    ];
    public $timestamps=false;
}
