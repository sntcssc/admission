@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Email') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('verify.otp') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="otp" class="col-md-4 col-form-label text-md-end">
                                Enter OTP sent to {{ session('registration_email') }}
                            </label>

                            <div class="col-md-6">
                                <input id="otp" type="text" 
                                    class="form-control @error('otp') is-invalid @enderror" 
                                    name="otp" required autocomplete="off" autofocus>

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Verify OTP
                                </button>

                                <a href="{{ route('resend.otp') }}" class="btn btn-link">
                                    Resend OTP
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection