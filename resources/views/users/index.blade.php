@extends('layout')
@section('title', 'Users List')
@section('subtitle', 'Users List')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <!-- <a href="" class="btn btn-primary mt-3">ADD<i class="bi bi-plus"></i></a> -->
            <div class="box-header with-border mt-3" id="filter-box">
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="alert alert-success rolemsg"style="display:none;">
                </div>
                <br>
                <div class="box-body table-responsive" style="margin-bottom: 5%">
                    <table class="table table-borderless dashboard" id="role_table">
                        <thead>
                            <tr>
                            <th>Online</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <!-- <th>Password</th> -->
                            <th>State</th>
                            <th>Role</th>
                            <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                         @if (!empty($users))
                        @forelse($users as $data)
                            <tr>
                            @php
                            $current_time = date("Y-m-d H:i:s"); 
                            $time_difference = strtotime($current_time);
                            @endphp
                            @if(isset($data->last_activity) && $data->last_activity)
                            @php
                                $time_difference = strtotime($current_time) - strtotime($data->last_activity);
                            @endphp
                            @endif
                            @if($time_difference > 300)
                            @php
                                $onlineUser ='color:#ff9c07;';
                            @endphp
                            @else
                            @php
                                $onlineUser ='color:#208719c7;';
                            @endphp
                            @endif
                            <td> <i style="@isset($onlineUser) {{ $onlineUser }} @endisset font-size: 12px;" class="bi bi-circle-fill me-2"></i>
                             @if(!empty($data->last_activity))
                                @php
                                echo date("m-d-Y h:i a", strtotime($data->last_activity));
                                @endphp
                                @else
                                @php
                                echo "----";
                                @endphp
                                @endif
                             </td>
                             <td>{{ $data->name}}</td>
                             <td>{{ $data->phone}}</td>
                             <td> {{ $data->email ?? '----'}} </td>
                             <!-- <td>{{ $data->password}}</td> -->
                             <td>{{ $data->state}}</td>
                                <td>
                                <!-- <div class="form-check">
                                <input class="form-check-input" type="radio" name="roleuser_{{$data->id}}" id="dataentryuser_{{$data->id}}" onclick="changeRoleFunc('{{$data->id}}', 5)" {{$data->role == 5 ? 'checked' : ''}}>
                                <label class="form-check-label" for="dataentryuser">
                                    Data Entry User
                                </label>
                                </div> -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roleuser_{{$data->id}}" id="proofinguser_{{$data->id}}" onclick="changeRoleFunc('{{$data->id}}', 3)" {{$data->role == 3 ? 'checked' : ''}}>
                                <label class="form-check-label" for="proofinguser">
                                    Draft User
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roleuser_{{$data->id}}" id="finalproofinguser_{{$data->id}}" onclick="changeRoleFunc('{{$data->id}}', 4)" {{$data->role == 4 ? 'checked' : ''}}>
                                <label class="form-check-label" for="finalproofinguser">
                                    Final Proofing User
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roleuser_{{$data->id}}" id="inchargeuser_{{$data->id}}" onclick="changeRoleFunc('{{$data->id}}', 2)" {{$data->role == 2 ? 'checked' : ''}}>
                                <label class="form-check-label" for="inchargeuser">
                                    Incharge User
                                </label>
                            </div>
                                </td>
                                <!-- <td></td> -->
                            </tr>
                            @empty
                            @endforelse
                            @else
                            <tr><td colspan="4">No data found.</td><tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_scripts')
@if (count($errors) > 0)
<script>
$(document).ready(function() {
    $('#addStore').modal('show');
});
</script>   
@endif
<script>
$(document).ready(function() {
    setTimeout(function() {
        $('.message').fadeOut("slow");
    }, 2000);
    $('#role_table').DataTable({
        "order": []
        //"columnDefs": [ { "orderable": false, "targets": 7 }]
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function deleteStoreOutwardProductReversal(id) {
if (confirm("Are you sure ?") == true) {
    // ajax
    $.ajax({
        type: "DELETE",
        url: "{{ url('/storeoutwardproductreversals/delete') }}",
        data: {
            id: id
        },
        dataType: 'json',
        success: function(res) {
            location.reload();
        }
    });
}
}
function changeRoleFunc(id,roleStatus){
    $.ajax({
        type: "POST",
        url: "{{ url('/user/role/change') }}",
        data: {
            id: id,
            roleStatus: roleStatus,
        },
        dataType: 'json',
        success: function(res) {
            if(res.status ==200){
                $(".rolemsg").html('User role changed successfully!');
                $(".rolemsg").show();
                setTimeout(function() {
                    $('.rolemsg').fadeOut("slow");
                }, 2000);
            }
        }
    });
}
</script>
@endsection