<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'date',
        'start_date',
        'end_date',
        'occasion',
        
    ];
    public $timestamps=false;
}
