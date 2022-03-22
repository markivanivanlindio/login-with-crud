@extends('templates.main')

@section('content')
    
    <div class="row">
        <div class="col-12">
        <h1 class="float-left">Users</h1>
        <a class="btn btn-sm btn-success float-right" href="{{ route('admin.users.create') }}" role="button">Create</a>
        </div>
    </div>
<br>
   
    <div class="card">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Region</th>
      <th scope="col">Province </th>
      <th scope="col">City</th>
      <th scope="col">Barangay</th>
      <!--<th scope="col">Barangay</th> -->
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)
  <tr>
      <th scope="row">{{ $user->id }}</th>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->regions->pluck('name') }}</td>
      <td>{{ $user->provinces->pluck('name')}}</td>
      <td>{{ $user->cities->pluck('name') }}</td>
      <td>{{ $user->barangays->pluck('name') }}</td>
     <!-- <td>{{ $user->cities->pluck('name') }}</td> -->
      <td>
        <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit', $user->id) }}" role="button">Edit</a>
        <button type="button" class="btn btn-sm btn-danger" 
        onclick="event.preventDefault(); document.getElementById('delete-user-form-{{$user->id}}').submit()" >Delete</button>

        <form id="delete-user-form-{{$user->id}}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none">
        @csrf
        @method("DELETE")
        </form>

      </td>
    </tr>
  @endforeach
  </tbody>
</table>
    {{$users->links()}}
    </div>
@endsection