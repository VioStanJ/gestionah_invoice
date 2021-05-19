@extends('layouts.auth')

@section('title')
Register
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <h4 class="text-center font-weight-bold mb-4 text-muted">Sign Up</h4>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <p class="mb-1 font-weight-bold tiblue">Company</p>
                        <hr class="mt-0 pt-0">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="company_name" class="col-form-label text-md-right">Company Name *</label>
                                    </div>

                                    <div class="col-md-12">
                                        <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="company_email" class="col-form-label text-md-right">Company Email</label>
                                    </div>

                                    <div class="col-md-12">
                                        <input id="company_email" type="text" class="form-control @error('company_email') is-invalid @enderror" name="company_email" value="{{ old('company_email') }}" autofocus>

                                        @error('company_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="col-form-label text-md-right">Country *</label>
                                    </div>

                                    <div class="col-md-12">
                                        <select class="form-control" name="country" required >
                                            <option value="">Select your country</option>
                                            @foreach($countries as $host)
                                                @if (old('country') == $host->id)
                                                    <option value="{{ $host->id }}" selected>{{ $host->name}}</option>
                                                @else
                                                    <option value="{{ $host->id }}">{{ $host->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color:pink;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="city" class="col-form-label text-md-right">City</label>
                                    </div>

                                    <div class="col-md-12">
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autofocus>

                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="mb-1 font-weight-bold tiblue mt-2">Owner</p>
                        <hr class="mt-0 pt-0">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="col-form-label text-md-right">Name *</label>
                                    </div>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="phone" class="col-form-label text-md-right">Phone *</label>
                                    </div>

                                    <div class="col-md-12">
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autofocus>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="email" class="col-form-label text-md-right">E-mail *</label>
                                    </div>

                                    <div class="col-md-12">
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="password" class="col-form-label text-md-right">Password *</label>
                                    </div>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="password_confirmation" class="col-form-label text-md-right">Password Confirmation *</label>
                                    </div>

                                    <div class="col-md-12">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autofocus>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row mb-4 mt-4">
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
