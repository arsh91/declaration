<!DOCTYPE html>
<html lang="en">
@include('includes.css')
<style>
    .select2-container {
        border: 1px solid #ced4da !important;
        border-radius: 4px;
        width: 281.528px;
        padding: 0.375rem 2.25rem 0.375rem 0.75rem;
        -moz-padding-start: calc(0.75rem - 3px);
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 0px;
        border-radius: 0px;
    }
    .headerBtn:hover{
        color: #fefefe !important;
        border-color: #0d6efd !important;
        background-color: #0d6efd !important;
    }   
    @media (max-width:700px){
        .select2-container {
            width: 247px;
        }
        .storeSelectForm{
            width: 247px;
        }
        .headerBtn{
            font-size: 10px;
            margin-top: 3px;
        }
        .headerBtnDiv{
            display: flex;
        }
        #main{
          height: 80px !important;  
        }
        #header{
            height: 80px !important;
        }
        .extendedHeaderItems{
            display:block !important;
        }
        .headerCont{
            margin-bottom: 35px !important;
        }
    }
</style>
<body>
    <main id="main" class="main">
        <!-- Navigation -->
        @include('includes.header')
        <!-- Navigation -->
        <div class="pagetitle">
            <h1>@yield('title')</h1>
            <!-- <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav> -->
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body"> -->
                @yield('content')
                <!-- </div>
                    </div>
                </div> -->
            </div>
        </section>
    </main>
    @include('includes.jss')
    <script type="text/javascript">
    $(document).ready(function() {
        $(".search_select").select2(); 

        $('#selectStore').change(function() {
            $('form[name=storeSelectForm]').submit();
        });
    });
    </script>
    @yield('js_scripts')
</body>

</html>