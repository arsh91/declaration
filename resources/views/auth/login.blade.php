@section('title', 'Login')
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
                                    <span class="d-none d-lg-block">Document</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login </h5>
                                        <p class="text-center small">Enter your phone & password to login</p>
                                    </div>

                                    <form method="post" action="{{ route('login.user') }}"
                                        class="row g-3 needs-validation" novalidate>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <div class="col-12">
                                            <label for="email" class="form-label">Phone</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="phone" class="form-control" id="phone"
                                                    required>
                                            </div>
                                            @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        @if ($errors->has('credentials_error'))
                                        <span class="text-danger">{{ $errors->first('credentials_error') }}</span>
                                        @endif
                                        <!--<div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>-->
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a href="{{ route('register.index') }}">Create an account</a></p>
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

    </script>
</body>

</html>