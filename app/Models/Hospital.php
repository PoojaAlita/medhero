<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'like',
        'private_public_hospital',
        'status'
      
    ];
}
