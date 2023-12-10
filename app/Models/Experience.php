<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    /*
        * Author : kishan 
        * Date : 3/05/22
        * Added fillable property
    */
    protected $fillable = [
        'u_id',
        'position',
        'employment_type',
        'name',
        'logo',
        'country',
        'city',
        'start_date',
        'end_date',
        'description',
        'status',

    ];
    /*
        * Author : kishan 
        * Date : 3/05/22
        * end
    */
    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = ucwords($value);
    }
    public function setEmploymentTypeAttribute($value)
    {
        $this->attributes['employment_type'] = ucwords($value);
    }
    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = ucwords($value);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function setCityAttribute($value)
    {
        $this->attributes['city'] = ucwords($value);
    }
}
