<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Region;
use App\Models\RegionUser;
use App\Models\ProvinceUser;
use App\Models\CityUser;
use App\Models\BarangayUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],

            'password' => $this->passwordRules(),
            
        ])->validate();

        $user =  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        
        ]);

        $user->RegionUser = RegionUser::create([
            'user_id' => $user->id,
            'region_id' => $input['region_id'],
        ]);

        $user->ProvinceUser = ProvinceUser::create([
            'user_id' => $user->id,
            'province_id' => $input['province_id'],
        ]);

        $user->CityUser = CityUser::create([
            'user_id' => $user->id,
            'city_id' => $input['city_id'],
        ]);

        $user->BarangayUser = BarangayUser::create([
            'user_id' => $user->id,
            'barangay_id' => $input['barangay_id'],
        ]);

        return $user;
    }
}
