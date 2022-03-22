<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceUser extends Model
{
    use HasFactory;

  protected $table = 'province_user';

protected $fillable = [
    'user_id',
    'province_id',
];
}
