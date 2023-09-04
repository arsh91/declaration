@extends('layout')
@section('title', 'Dashboard')
@section('subtitle', 'Dashboard')
@section('content')
<!-- <div class=""> -->
<div class="col-lg-8 dashboard">
    <div class="row">
        <!-- Total organization member count card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="filter">
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total users</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$usercount}}</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Total organization member count card --> 
        <div class="col-12">
            <div class="card">
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 dashboard">
    <!-- Recent Activity -->
</div>
</div>
@endsection
@section('js_scripts')
<script>
$(document).ready(function() {
});

</script>

@endsection