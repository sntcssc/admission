@extends('student.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg my-5">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">@yield('auth-title')</h3>
                </div>
                <div class="card-body">
                    @yield('auth-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection