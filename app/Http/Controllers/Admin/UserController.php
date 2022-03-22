<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use App\Models\RegionUser;
use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Gate::denies('logged-in')){
            dd('no access allowed');
        }

        if(Gate::allows('is-admin')){
            return view('admin.users.index', ['users' => User::paginate(10), 
            /*'regions' => Region::with('users')->get()*/ ]);
        }
       
        dd('YOu need to be admin');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.users.create', [
            'roles' => Role::all(),
            'regions' => Region::all()
             ]);  
             
       
    }

/* ===================================================*/
public function region_index()
{
    $data['regions'] = Region::get(["name", "id"]);
    return view('auth.register', $data);
    
}

public function fetchProvince(Request $request)
{
    $data['provinces'] = Province::where("region_id",$request->region_id)->get(["name", "id"]);
    return response()->json($data);
}
public function fetchCity(Request $request)
{
    $data['cities'] = City::where("province_id",$request->province_id)->get(["name", "id"]);
    return response()->json($data);
}

public function fetchBarangay(Request $request)
{
    $data['barangays'] = Barangay::where("city_id",$request->city_id)->get(["name", "id"]);
    return response()->json($data);
}

/* ===================================================*/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
      // dd($request);
      // $validatedData = $request->validated();
      //$user = User::create($validatedData);

      $newUser = new CreateNewUser();
       $user = $newUser->create($request->only('name', 'email', 'password', 'password_confirmation', 'region_id', 'province_id','city_id', 'barangay_id'));

       $user->roles()->sync($request->roles);

       $request->session()->flash('success', 'You have Created the user');

       return redirect(route('admin.users.index'));  
       
   // dd($request);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit', 
        [
            'roles' => Role::all(),
            'user' => User::find($id),
            'regions' => Region::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if(!$user){
            $request->session()->flash('error', 'You cannot edit this user');
            return redirect(route('admin.users.index'));
        }

        $user->update($request->except(['_token', 'roles']));
        
        $user->roles()->sync($request->roles);
        $user->regions()->sync($request->region_id);

        $request->session()->flash('success', 'You have edited the user');

        return redirect(route('admin.users.index'));

       // dd($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
       // dd($id);
       User::destroy($id);

       $request->session()->flash('success', 'You have deleted the user');

       return redirect(route('admin.users.index'));
    }
}
