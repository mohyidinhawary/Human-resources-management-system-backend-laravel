<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranche extends Model
{
    use HasFactory;
    protected $fillable = [
        "branch_name",
        
    ];
    public $timestamps=false;
}
