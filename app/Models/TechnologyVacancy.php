<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TechnologyVacancy extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'technologie_id',
        'vacancie_id'  
    ];
}
