<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'remote',
        'hiring',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'technology_vacancies')->withPivot('technology_id');
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidates_vacancies')->withPivot('candidate_id');
    }
}
