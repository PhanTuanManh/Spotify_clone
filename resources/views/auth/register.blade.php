<!doctype html>
<html lang="en">

<head>
    <title>Webleb</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
</head>

<body>
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span class="span1" onclick="window.location.href='/login'">Log In
                            </span><span class="span2">Sign Up</span></h6>
                        {{-- <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/> --}}
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper card">
                                {{-- <div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
                      <form method="POST" action="{{ route('login.perform') }}">
                        <h4 class="mb-4 pb-3">Log In</h4>
											<div class="form-group">
												<input type="email" class="form-style" name="email" placeholder="Email">
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" class="form-style" name="password" placeholder="Password">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<button type="submit" class="btn mt-4">Login</button>
                      </form>
                      <p class="mb-0 mt-4 text-center"><a href="https://www.web-leb.com/code" class="link">Forgot your password?</a></p>
				      					</div>
			      					</div>
			      				</div> --}}
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <form method="post" action="{{ route('register.perform') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <h4 class="mb-3 pb-3">Sign Up</h4>
                                                <div class="form-group">
                                                    <input type="text" class="form-style"
                                                        name="username"value="{{ old('username') }}"
                                                        placeholder="Username" required="required" autofocus>
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" class="form-style" name="email"
                                                        value="{{ old('email') }}" placeholder="name@example.com"
                                                        required="required" autofocus>
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" class="form-style" name="password"
                                                        value="{{ old('password') }}" placeholder="Password"
                                                        required="required">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" class="form-style"
                                                        name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}"
                                                        placeholder="Confirm Password" required="required">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button type="submit" value="save" class="btn mt-4">Register</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
