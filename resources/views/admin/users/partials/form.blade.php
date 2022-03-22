@csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " id="name" aria-describedby="name" 
    value="{{ old('name') }} @isset($user) {{ $user->name }} @endisset">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" 
    value="{{ old('email') }} @isset($user) {{ $user->email }} @endisset">
    @error('email')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
  </div>
<!------------------------------------------------------------------------------->

<div class="form-group mb-3 ">

    <select  id="region-dd" name="region_id" class="form-control @error('region_id') is-invalid @enderror" id="region_id">
    <option value="">Select Region</option>
    @foreach ($regions as $data)
    <option value="{{$data->id}}" id="{{ $data->name }}">
    {{$data->name}}
    </option>
     @endforeach
    </select>
    @error('region_id')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
    </div> 
    
    <div class="form-group mb-3">
     <select id="province-dd" name="province_id" class="form-control @error('province_id') is-invalid @enderror" id="province_id">
     <option value=""> Select Province</option>
     </select>
     @error('province_id')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
    </div>

     <div class="form-group">
    <select id="city-dd" name="city_id" class="form-control @error('city_id') is-invalid @enderror" id="city_id">
    <option value=""> Select City</option>
    </select>
    @error('city_id')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
    </div> 
<br>

    <div class="form-group">
    <select id="barangay-dd" name="barangay_id" class="form-control @error('barangay_id') is-invalid @enderror" id="barangay_id">
    <option value=""> Select Barangay</option>
    </select>
    @error('barangay_id')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
    </div> 

    
    
<!------------------------------------------------------------------------------->

  @isset($create)
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
    @error('password')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
  </div>

  <div class="mb-3">
    <label for="password_confirmation" class="form-label">Password Confirm</label>
    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password">
    @error('password_confirmation')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
  </div>

  @endisset

  <div class="mb-3">
      @foreach($roles as $role)
        <div class="form-check">
            <input class="form-check-input" name="roles[]" type="checkbox" 
            value="{{ $role->id }}" id="{{ $role->name }}" @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset >
      <label class="form-check-label" for="{{ $role->name }}">
          {{$role->name}}
        </label>
        </div>
      @endforeach
  </div>


  <!----------------------------------------------------------------------------------------->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#region-dd').on('change', function () {
                var idRegion = this.value;
                $("#province-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-provinces')}}",
                    type: "POST",
                    data: {
                        region_id: idRegion,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#province-dd').html('<option value="">Select Province</option>');
                        $.each(result.provinces, function (key, value) {
                            $("#province-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#province-dd').on('change', function () {
                var idProvince = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        province_id: idProvince,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            
            $('#city-dd').on('change', function () {
                var idCity = this.value;
                $("#barangay-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-barangays')}}",
                    type: "POST",
                    data: {
                        city_id: idCity,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#barangay-dd').html('<option value="">Select City</option>');
                        $.each(res.barangays, function (key, value) {
                            $("#barangay-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            

 
        });
    </script>
 
  <button type="submit" class="btn btn-primary">Submit</button>