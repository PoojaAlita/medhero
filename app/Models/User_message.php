<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_message extends Model
{
    use HasFactory;
    /* relation to messages fetching all message of an user */
    public function messages(){
        return $this->hasMany('App\Models\Message', 'parent_id' ,'id');
    }
}
