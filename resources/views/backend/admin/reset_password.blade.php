<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eirehome - Administrative Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/custom.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        @if (session('error'))
            <x-alert type="danger" message="{{ session('error') }}" />

        @endif
        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}" />
        @endif
    </div>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-dark">
            <div class="card-header text-center">
                <a href="#" class="h3">Reset New Password</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">You are only one step a way from your new password.
                </p>
                <form action="{{ route('admin.reset.password.process', ['token' => $token, 'email' => $email]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="New Password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                            name="confirm_password" placeholder="New Password">
                        @error('confirm_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark">Change password</button>
                </form>
                <p class="mb-1 mt-3">
                    <a href="{{ route('admin.login') }}" class="text-dark">Back to login</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('backend/admin/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/admin/assets/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend/admin/assets/js/demo.js') }}"></script>
</body>

</html>
