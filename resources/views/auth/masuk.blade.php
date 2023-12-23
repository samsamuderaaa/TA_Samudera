@section('content')
@section('title', 'Login')
@extends('layouts.layout')
<div class="container" style="padding-top:50px;">
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="myAlert">
        {{ session('error') }}
        <button type="button" class="btn-close custom-close-button" data-bs-dismiss="alert" aria-label="Close"> <i class="fas fa-times"></i></button>
    </div>
    @endif
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class=" card-header" style="background-color:white;">
                    <h2 class="text-center" style="color:#FF914D;"> Login </h2>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div>
                            <button type="submit" class="btn"
                                style="background-color:#FF914D; float:left; color:white">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
