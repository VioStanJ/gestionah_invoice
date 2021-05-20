@extends('layouts.auth')

@section('title')
E-mail Verification
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">E-mail Verification</div>

                <div class="card-body">
                    <p class="text-danger mb-2">{{ __('Your verification Code is expired or not exist !') }}</p>
                    <br>
                    <p class="mb-0 text-muted">{{ __('Please check your email for a verification link.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
