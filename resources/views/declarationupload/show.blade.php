@extends('layout')
@section('title', 'Declaration Upload List')
@section('subtitle', 'Declaration List')
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
                <br>
                <div class="box-body table-responsive" style="margin-bottom: 5%">
                    <table class="table table-borderless dashboard" id="role_table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Uploded Adharcard</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Upload User</th>
                                <th>Proofing</th>
                                <th>Final Proofing</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_scripts')
<script>
$(document).ready(function() {
    setTimeout(function() {
        $('.message').fadeOut("slow");
    }, 2000);
    $('#role_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('declaration.show') }}",
            columns: [
                { data: 'Id', name: 'Id', 
                    render: function (data, type, row) {
                      return row.id;    
                    }
                },
                { data: 'Uploded Adharcard', name: 'Uploded Adharcard',            
                    render: function (data, type, row) {
                        return '<a href="/'+row.file+'" target="_blank" ><i class="bi-file-earmark-post-fill"></i></a>';
                    },
                },
                { data: 'Status', name: 'Status',
                    render: function (data, type, row) {
                        if (row.status === 'draft') {
                            return '<span class="badge rounded-pill draft">Draft</span>';
                        } else if (row.status === 'proofed') {
                            return '<span class="badge rounded-pill proofed">Proofed</span>';
                        } else if (row.status === 'final_proofed') {
                            return '<span class="badge rounded-pill finalproofed">Final Proofed</span>';
                        } else {
                            return '----';
                        }
                    }
                 },
                { data: 'Type', name: 'Type',
                    render: function (data, type, row) {
                        var selectOptions = '<select name="type_filter" class="form-select" style="width:200px;" id="' + row.id + '_type_filter" onChange="typeChange(' + row.id + ')">';
                        selectOptions += '<option value="">Type</option>';
                        selectOptions += '<option value="blur"' + (row.type === "blur" ? ' selected' : '') + '>Blur</option>';
                        selectOptions += '<option value="not_clear"' + (row.type  === "not_clear" ? ' selected' : '') + '>Not Clear</option>';
                        selectOptions += '<option value="text_missplaced"' + (row.type  === "text_missplaced" ? ' selected' : '') + '>Text Missplaced</option>';
                        selectOptions += '<option value="position_not_correct"' + (row.type  === "position_not_correct" ? ' selected' : '') + '>Position Not correct</option>';
                        selectOptions += '</select>';
                        return selectOptions;
                    }
                },
                { data: 'Uploded User', name: 'Uploded User',
                render: function (data, type, row) {
                        return "------";
                    }
                },
                { data: 'prooftuser.name', name: 'Proofing', 
                    render: function (data, type, row) {
                        if (row.proofed_user_id == null) {
                            return '<button class="btn btn-primary mt-3" style="padding: 3px; font-size: 13px;" onClick="declarationStatusChange(' + row.id + ', \'proofed\')">Proofing</button>';
                        }else{
                            return row.prooftuser.name;
                        }
                    }},
                { data: 'Final Proofing', name: 'Final Proofing',
                    render: function (data, type, row) {
                        if (row.final_proofed_user_id == null) {
                            return '<button class="btn btn-primary mt-3" style="padding: 3px;font-size: 13px;" onClick="declarationStatusChange('+row.id+', \'final_proofed\')">Final Proofing</button>';
                        }else{
                            return row.finalproofuser.name;
                        }
                    }
                 },
                { data: 'Action', name: 'Action', orderable: false, searchable: false, 
                    render: function (data, type, row) {
              
                        return  '<i style="color:#4154f1;" onClick="deleteuploaddeclaration('+row.id+')" href="javascript:void(0)" class="fa fa-trash fa-fw pointer"></i>';
                    }
                 },
            ],
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function deleteuploaddeclaration(id) {
if (confirm("Are you sure ?") == true) {
    // ajax
    $.ajax({
        type: "DELETE",
        url: "{{ url('/declaration/upload/delete') }}",
        data: {
            id: id,
        },
        dataType: 'json',
        success: function(res) {
            location.reload();
        }
    });
}
}

function declarationStatusChange(id, status) {
if (confirm("Are you sure want to change status of Id: "+id ) == true) {
    // ajax
    $.ajax({
        type: "POST",
        url: "{{ url('/declaration/status/change') }}",
        data: {
            id: id,
            status: status
        },
        dataType: 'json',
        success: function(res) {
            location.reload();
        }
    });
}
}
function typeChange(id) {
    var type = $("#"+id+"_type_filter :selected").val();
    // ajax
    $.ajax({
        type: "POST",
        url: "{{ url('/declaration/type/change') }}",
        data: {
            id: id,
            type: type
        },
        dataType: 'json',
        success: function(res) {
            location.reload();
        }
    });
}

</script>
@endsection