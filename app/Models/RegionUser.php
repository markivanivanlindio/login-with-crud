<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionUser extends Model
{
    use HasFactory;
/*
    public function users()
    {
    return $this->belongsTo(User::class);
    }
*/
protected $table = 'region_user';

protected $fillable = [
    'user_id',
    'region_id',
];

}
