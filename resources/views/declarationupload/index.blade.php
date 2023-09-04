@extends('layout')
@section('title', 'Declaration Upload')
@section('subtitle', 'Declaration Upload')
@section('content')

<div class="col-lg-12" style="display: flex;justify-content: center;">
    <div class="card" style="width:500px;">
        <div class="card-body">
            <div class="box-header with-border mt-5" id="filter-box">
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form method="post" id="declarationupload" action="{{ route('declaration.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="row mb-3 p-2">
                        <input type="file" class="form-control" name="attachment[]" multiple required>
                        </div>
                    <div class="card-footer text-center">
                        <button type="submit" name="submitUpload" class="btn btn-primary">Upload</button>
                    </div>
            </form>
                
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
});
</script>
@endsection