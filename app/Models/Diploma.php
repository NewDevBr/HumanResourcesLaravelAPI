<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diploma extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course',
        'institution',
        'initial_date',
        'final_date'
    ];

}
