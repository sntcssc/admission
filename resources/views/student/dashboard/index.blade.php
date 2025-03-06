@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('student.dashboard.partials.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Student Dashboard</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general-instructions">
                            <h4>General Instructions</h4>
                            <!-- Content here -->
                        </div>
                        
                        <div class="tab-pane fade" id="online-applications">
                            <h4>Online Applications</h4>
                            <!-- Content here -->
                        </div>
                        
                        <div class="tab-pane fade" id="application-history">
                            <h4>Application History</h4>
                            <!-- Content here -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection