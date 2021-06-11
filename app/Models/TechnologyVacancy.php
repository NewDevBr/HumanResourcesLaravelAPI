<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnologyVacancy extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'technologie_id',
        'vacancie_id'  
    ];
}
