
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Register</b>LTE</a>
  </div>

  <div class="">
    <div class="">
      <p class="login-box-msg">Register a new membership</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group mb-3">
            <x-input-label for="name" :value="__('')" />
            <x-text-input id="name" placeholder="User Name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="input-group mb-3">
            <x-input-label for="email" :value="__('')" />
            <x-text-input id="email" class="form-control" placeholder="Email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="input-group mb-3">

                <x-input-label for="password" :value="__('')" />

                <x-text-input id="password" class="form-control"
                                type="password"
                            placeholder="Password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>
        <div class="input-group mb-3">
            <x-input-label for="password_confirmation" :value="__('')" />

            <x-text-input id="password_confirmation" class="form-control"
                            type="password"
                            placeholder="Retype password"
                            name="password_confirmation"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <x-primary-button >
                {{ __('Register') }}
            </x-primary-button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a class="" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
