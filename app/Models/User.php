<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'password',
        'latitude',
        'longitude',
        'cover_image',
        'user_status',
        'approval',
        'remember_token',
        'timezone',
        'google_id'
    ];

    protected $primaryKey = 'id';


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
   /*  protected $hidden = [
        'password',
    ];
 */
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords($value);
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords($value);
    }
    public function setHospitalNameAttribute($value)
    {
        $this->attributes['hospital_name'] = ucwords($value);
    }
    public function setHeadlineAttribute($value)
    {
        $this->attributes['headline'] = ucwords($value);
    }
    public function setGradePrimaryAttribute($value)
    {
        $this->attributes['grade_primary'] = ucwords($value);
    }
    public function setGradeSecondaryAttribute($value)
    {
        $this->attributes['grade_secondary'] = ucwords($value);
    }
    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = ucwords($value);
    }
    public function setCityAttribute($value)
    {
        $this->attributes['city'] = ucwords($value);
    }
    /* relation to education */
    public function education()
    {
        return $this->hasMany('App\Models\Education', 'u_id', 'id')->where('status',1);
    }
    /* relation to experience */
    public function experience()
    {
        return $this->hasMany('App\Models\Experience', 'u_id', 'id')->where('status',1);
    }
    /* relation to Connect on from_id */
    public function from_connections()
    {
        return $this->hasMany('App\Models\Connect', 'from_id' , 'id');
    }
    /* relation to Connect on to_id */
    public function to_connections()
    {
        return $this->hasMany('App\Models\Connect', 'to_id' , 'id');
    }
    /* relation to user_messages on receiver id */
    public function sender_messages(){
        return $this->belongsToMany('App\Models\User', 'user_messages', 'r_id', 's_id');
    }
    /* relation to user_messages on sender id */
    public function receiver_messages() {
        return $this->belongsToMany('App\Models\User', 'user_messages', 's_id', 'r_id');
    }
    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'user_skills', 'user_id', 'skill_id');
    }

    public function language()
    {
        return $this->belongsToMany(Language::class, 'user_languages', 'user_id', 'language_id');
    }
    /* getting profile url in ideal form  */
    public function getProfileAttribute($value) 
    {      
        return profileCheck($value);  /* calling helper function */
    }
     /* Relation To Thumb*/
     public function thumb()
     {
        return $this->hasMany(Thumb::class, 'user_id', 'id');
     }
       /* Relation To Hospital*/
       public function hospital()
       {
          return $this->hasOne(Hospital::class, 'user_id', 'id');
       }

      /* Relation To Job Post*/
      public function job_post()
      {
         return $this->hasMany(JobPost::class, 'user_id', 'id');
      }

       /* Relation To Doctor*/
       public function doctor()
       {
          return $this->hasOne(Doctor::class, 'user_id', 'id');
       }


     
}
