<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    /*
        * Author : kishan 
        * Date : 3/05/22
        * Added fillable property
    */
    protected $fillable = [
        'u_id',
        'name',
        'logo',
        'degree',
        'grade',
        'start_date',
        'end_date',
        'description',
        'status',
    ];
    /*
        * Author : kishan 
        * Date : 3/05/22
        * End 
    */
    public function setDegreeAttribute($value)
    {
        $this->attributes['degree'] = ucwords($value);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function setGradeAttribute($value)
    {
        $this->attributes['grade'] = ucwords($value);
    }
}
