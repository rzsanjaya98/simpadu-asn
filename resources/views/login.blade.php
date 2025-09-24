<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <meta name="description" content="POS - Bootstrap Admin Template">
      <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
      <meta name="author" content="Dreamguys - Bootstrap Admin Template">
      <meta name="robots" content="noindex, nofollow">
      <title>Login</title>
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboard_admin/assets/img/favicon.jpg')}}">
      <link rel="stylesheet" href="{{ asset('dashboard_admin/assets/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('dashboard_admin/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
      <link rel="stylesheet" href="{{ asset('dashboard_admin/assets/plugins/fontawesome/css/all.min.css')}}">
      <link rel="stylesheet" href="{{ asset('dashboard_admin/assets/css/style.css')}}">
   </head>
   <body class="account-page">
      <div class="main-wrapper">
         <div class="account-content">
            <div class="login-wrapper">
               <div class="login-content">
                  <div class="login-userset">
                    <div class="login-userheading">
                        <h1 class="display-6 fw-bold">Simpadu-ASN</h1>
                    </div>
                     {{-- <div class="login-logo">
                        <img src="{{ asset('dashboard_admin/assets/img/sultra.png')}}" alt="img">
                     </div> --}}
                     <div class="login-userheading">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li><strong>{{ $error }}</strong></li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h3>Sign In</h3>
                        <h4>Please login to your account</h4>
                     </div>
                     <form action="login" method="POST">
                        @csrf
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="text" name="email" required placeholder="Enter your email address">
                                <img src="{{ asset('dashboard_admin/assets/img/icons/mail.svg')}}" alt="img">
                            </div>
                        </div>
                        <div class="form-login">
                            <label>Password</label>
                            <div class="pass-group">
                                <input type="password" name="password" class="pass-input" required placeholder="Enter your password">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                        {{-- <div class="form-login">
                            <div class="alreadyuser">
                                <h4><a href="forgetpassword.html" class="hover-a">Forgot Password?</a></h4>
                            </div>
                        </div> --}}
                        <div class="form-login">
                            <button class="btn btn-login">Sign In</button>
                        </div>
                        {{-- <div class="signinform text-center">
                            <h4>Don’t have an account? <a href="signup.html" class="hover-a">Sign Up</a></h4>
                        </div>
                        <div class="form-setlogin">
                            <h4>Or sign up with</h4>
                        </div>
                        <div class="form-sociallink">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('dashboard_admin/assets/img/icons/google.png')}}" class="me-2" alt="google">
                                        Sign Up using Google
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('dashboard_admin/assets/img/icons/facebook.png')}}" class="me-2" alt="google">
                                        Sign Up using Facebook
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                     </form>
                  </div>
               </div>
               <div class="login-img">
                  <img src="{{ asset('dashboard_admin/assets/img/bappeda.jpg')}}" alt="img">
               </div>
            </div>
         </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script src="{{ asset('dashboard_admin/assets/js/jquery-3.6.0.min.js')}}"></script>
      <script src="{{ asset('dashboard_admin/assets/js/feather.min.js')}}"></script>
      <script src="{{ asset('dashboard_admin/assets/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ asset('dashboard_admin/assets/js/script.js')}}"></script>
   </body>
</html>