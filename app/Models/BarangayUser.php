<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayUser extends Model
{
    use HasFactory;

    protected $table = 'barangay_user';

    protected $fillable = [
        'user_id',
        'barangay_id',
    ];
}
