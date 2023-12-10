@extends('layouts.app')

@section('content')
@if (session('success'))
    <script>
        swal({
            title: "Success!",
            text: "{{ session('success') }}",
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "OK",
            closeOnConfirm: true
        });
    </script>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="order-1 order-lg-2 row justify-content-center" data-aos="zoom-in" data-aos-delay="200">
            <div class="card shadow col-7">
                <div class="card-header"><h5 class="text-success"><strong>Your Profile</strong></h5></div>
                <div class="card-body row justify-content-center">
                    <div class="col-12">
                        <form method="POST" action="{{ route('updateProfile') }}" class="p-3 border-bottom ">
                            @csrf
                            <input type="text" name="changeType" hidden value="0" class="form-control">
                            <div class="form-group p-1">
                                <h5>Profile Changes</h5>
                            </div>
                            <div class="form-group p-1">
                                <label for="">Name</label>
                                <input id="name" value="{{ $response->name }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group pt-2">
                                <button class="col-12 btn btn-success" type="submit">Confirm Changes</button>
                            </div>
                            
                        </form>

                        <form method="POST" action="{{ route('updateProfile') }}" class="p-3">
                            @csrf
                            <input type="text" name="changeType" hidden value="1" class="form-control">
                            <div class="form-group p-1">
                                <h5>Password Changes</h5>
                            </div>
                            <div class="form-group p-1">
                                <label for="">Email</label>
                                <input id="email" value="{{ $response->email }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group p-1">
                                <label for="">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group p-1">
                                <label for="">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
    
    
                            <div class="form-group pt-2">
                                <button class="col-12 btn btn-success" type="submit">Confirm Changes</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection