@section('title', 'Register')
<!DOCTYPE html>
<html lang="en">
@include('includes.css')

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Declaration</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                            <div class="card-body">
                            @if(session()->has('message'))
                            <div class="alert alert-success message">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                                <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                <p class="text-center small">Enter your personal details to create account</p>
                                </div>
                                <form method="post" action="{{ route('register.save') }}" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                <div class="col-12">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <label for="phone" class="form-label">Your Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone" maxlength="10" value="{{ old('phone') }}" required>
                                    @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                                </div>

                                <div class="col-12">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" id="state" value="{{ old('state') }}" required>
                                    @if ($errors->has('state'))
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <label for="Password" class="form-label">Password</label>
                                    <div style="display: flex;">
                                    <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}" required>
                                    <i class="bi bi-eye-slash mt-2" id="eye" style="margin-left: -30px; cursor: pointer;"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="Password" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                    @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

    @include('includes.jss')
    <script type="text/javascript">
    $(document).ready(function() {
    $('#eye').click(function(){
        if($(this).hasClass('bi-eye-slash')){
            $(this).removeClass('bi-eye-slash');
            $(this).addClass('bi-eye');
            $('#password').attr('type','text');
        }else{
            $(this).removeClass('bi-eye');
            $(this).addClass('bi-eye-slash');  
            $('#password').attr('type','password');
        }
    });
    });
    </script>
</body>

</html>