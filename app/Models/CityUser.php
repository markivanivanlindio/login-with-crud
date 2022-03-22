<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityUser extends Model
{
    use HasFactory;

    protected $table = 'city_user';

    protected $fillable = [
        'user_id',
        'city_id',
    ];

}
