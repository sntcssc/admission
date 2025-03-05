@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#instructions" data-toggle="tab">
                            General Instructions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#applications" data-toggle="tab">
                            Online Applications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#history" data-toggle="tab">
                            Application History
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="instructions">
                    @include('dashboard.instructions')
                </div>
                <div class="tab-pane fade" id="applications">
                    @include('dashboard.applications')
                </div>
                <div class="tab-pane fade" id="history">
                    @include('dashboard.history')
                </div>
            </div>
        </main>
    </div>
</div>
@endsection