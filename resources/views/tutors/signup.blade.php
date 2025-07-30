@php
    $company = \App\Helpers\Global_helper::companyDetails();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Loanswala - Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/'.$company->favicon) }}">

    <!-- CSS Links -->
    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="auth-page" style="background:#f5f8fa url('assets/img/signup.png'); background-size: cover; background-position: center center;">

    <section class="section-bg py-5" style="background-color: #f5f8fa;">
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow">
                        <div class="card-body p-0 auth-header-box" style="background: #f2f2f3;">
                            <div class="text-center p-3">
                                <h4 class="mt-3 mb-1 fw-semibold text-dark font-18">Sign Up</h4>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form class="my-4" method="POST" enctype="multipart/form-data" id="tutors-signup">
                                @csrf
                                <input type="hidden" name="role_id" id="tutor_role_id" value="7">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control fs-13px h-45px @error('name') is-invalid @enderror" id="tutor_name" name="name" placeholder="Enter your name" required>
                                    <label for="tutor_name">Name</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control fs-13px h-45px @error('email') is-invalid @enderror" id="tutor_email" name="email" placeholder="Enter your email" required>
                                    <label for="tutor_email">Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control fs-13px h-45px @error('mobile') is-invalid @enderror" id="tutor_mobile" name="mobile" placeholder="Enter your mobile" required>
                                    <label for="tutor_mobile">Mobile No</label>
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control fs-13px h-45px @error('password') is-invalid @enderror" id="tutor_password" name="password" placeholder="Enter your password" required>
                                    <label for="tutor_password">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3 tutor_otp d-none">
                                    <input type="text" class="form-control fs-13px h-45px otp" id="tutor_otp" name="otp" placeholder="Enter your OTP">
                                    <input type="hidden" id="tutor_login_id" name="login_id">
                                    <label for="tutor_otp">OTP</label>
                                    @error('otp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">Please enter the OTP sent to your email.</div>
                                </div>

                                <span class="tutor-success text-success"></span>
                                <span class="text-danger form_error"></span>
                                <span class="tutor-error text-danger"></span>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary h-45px">Sign up</button>
                                </div>

                                <div class="mt-3 text-center">
                                    <p>Already have an account? <a href="{{ route('login') }}" class="text-primary">Login here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tutors-signup').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tutors.signup') }}", // Laravel route
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == "error") {
                            $(".tutor-success").text(' ');
                            $('.tutor-error').text(response.message);
                        }
                        if (response.status == "success") {
                            $('.form_error').html(' ');
                            $(".tutor-error").text(' ');

                            if (response.message === "Registration successfull!") {
                                $('.tutor_otp').addClass("d-none");
                                $("#tutor_name").val('');
                                $("#tutor_email").val('');
                                $("#tutor_mobile").val('');
                                $("#tutor_password").val('');
                                $('.tutor-success').text(response.message);
                            }
                            if (response.message === "Verify Your Mobile No") {
                                $('.tutor_otp').removeClass("d-none");
                                $('#otp').attr('required', true);
                                $('.tutor-success').text(response.message);
                                $('#tutor_login_id').val(response.data);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $('.form_error').html(error);
                        } else {
                            alert(response.error);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
