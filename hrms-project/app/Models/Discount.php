<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        "employee_id",
        "discount_date",
        "loan",
        "absence",
        "late",
        "early_leaving",
        "discount_amount",
        "discount_details"
        
    ];
    public $timestamps=false;
}
