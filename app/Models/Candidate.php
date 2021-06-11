<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidate extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pathPhoto',
        'name',
        'titration',
        'birthDate',
        'email',
        'password',
        'github',
        'linkedin',
        'email_verified_at',
        'notify_email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'notify_email'=>'boolean',
        'birthDate'=>'datetime'
    ];

    public function diplomas()
    {
        return $this->belongsToMany(Diploma::class, 'candidate_diplomas');
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'technology_candidates');
    }

    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'candidates_vacancies');
    }
}
