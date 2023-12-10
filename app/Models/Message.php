<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /* relation to user_message table */
    public function user_messages(){
        return $this->hasOne('App\Models\User_message', 'id' ,'parent_id');
    }
    /* getting created at in formate */
    public function getCreatedAtAttribute($value) 
    {      
       $timezone = (auth()->user())->timezone ;
       $c_at = Carbon::parse($value)->timezone($timezone);
       return $c_at->format('g:i A');
    }
}
