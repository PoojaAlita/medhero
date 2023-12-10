<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'work_period',
        'experience',
        'hourly_rate',
        'description',
        'attach_file',
    ];

    public function job_skill()
    {
        return $this->belongsToMany(Skill::class, 'job_skills', 'job_id', 'skill_id');
    }

    /* Relation To  job_languages*/
    public function language_job()
    {
        return $this->belongsToMany(Language::class, 'job_languages', 'job_id', 'language_id');
    }

     /* Relation To User*/
     public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

     /* Relation To Job Apply*/
     public function job_apply(){
        return $this->hasOne(JobApplication::class, 'job_id', 'id');
    }
   
}
