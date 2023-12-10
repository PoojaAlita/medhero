<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'user_id',
        'job_id',
        'offer'
    ];

     /* Relation To User*/
     public function User()
     {
        return $this->hasOne(User::class, 'id', 'user_id');
     }
      /* Relation To Job Post*/
      public function job()
      {
         return $this->hasOne(JobPost::class, 'id', 'job_id');
      }
     
}
