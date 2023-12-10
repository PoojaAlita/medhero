<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'medical_registration_no',
        'profile_image',
    ];

    /* Relation To User*/
    public function user(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }
     /* Relation To Job Apply*/
     public function job_apply(){
        return $this->hasOne(JobApplication::class, 'user_id', 'id');
    }
}
