<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDiploma extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'diploma_id'
    ];
}
