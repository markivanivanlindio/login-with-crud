<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
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
        'password',
     
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
/*
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }
*/
   
    public function roles(){
    return $this->belongsToMany('App\Models\Role');
    }

    public function regions(){
        return $this->belongsToMany('App\Models\Region');
        }

        public function provinces(){
            return $this->belongsToMany('App\Models\Province');
            }

            public function cities(){
                return $this->belongsToMany('App\Models\City');
                }

                public function barangays(){
                    return $this->belongsToMany('App\Models\Barangay');
                    }

     /**
     * Check if user has a role
     * @param string $role
     * @return bool
     */

    public function hasAnyRole(string $role){
        return null !== $this->roles()->where('name', $role)->first();
    }

      /**
     * Check if user has any given role
     * @param array $role
     * @return bool
     */

    public function hasAnyRoles(array $role){
        return null !== $this->roles()->whereIn('name', $role)->first();
    }

 

/*
        public function regions()
        {
            return $this->hasOne(Region::class);
        }  */
}
