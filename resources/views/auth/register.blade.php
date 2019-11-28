<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{ asset('tabler/favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('tabler/favicon.ico') }}" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('tabler/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('tabler/assets/fonts/latin-ext.css') }}">
    <script src="{{ asset('tabler/assets/js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '{{ url('tabler') }}'
        });
    </script>
    <!-- Dashboard Core -->
    <link href="{{ asset('tabler/assets/css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('tabler/assets/js/dashboard.js') }}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('tabler/assets/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('tabler/assets/plugins/charts-c3/plugin.js') }}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{ asset('tabler/assets/plugins/maps-google/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('tabler/assets/plugins/maps-google/plugin.css') }}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{ asset('tabler/assets/plugins/input-mask/plugin.js') }}"></script>
</head>
<body class="">
	<div class="page">
		<div class="page-single">
			<div class="container">
				<div class="row">
					<div class="col col-login mx-auto">
						<div class="text-center mb-6">
							<img src="{{ asset('tabler/assets/brand/tabler.svg') }}" class="h-6" alt="">
						</div>
                        
                        {!! Form::open(['route'=>'register', 'method'=>'POST', 'class'=>'card']) !!}
                            <div class="card-body p-6">
                              <div class="card-title">Create new account</div>

                              <div class="form-group">
                                <label class="form-label">Name</label>
                                {!! Form::text('name', null, ['class'=>$errors->has('password') ? 'form-control is-invalid' : 'form-control', 'placeholder'=>'Enter name']) !!}

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                              </div>

                              <div class="form-group">
                                <label class="form-label">Email address</label>
                                {!! Form::email('email', null, ['class'=>$errors->has('email') ? 'form-control is-invalid' : 'form-control', 'placeholder'=>'Enter email']) !!}
                                
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="form-label">Password</label>
                                {!! Form::password('password', ['class'=>$errors->has('password') ? 'form-control is-invalid' : 'form-control']) !!}

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                {!! Form::password('password_confirmation', ['class'=>$errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control']) !!}

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" />
                                  <span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
                                </label>
                              </div>
                              <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                              </div>
                            </div>
                          </form>
                          <div class="text-center text-muted">
                            Already have account? <a href="{{ route('login') }}">Sign in</a>
                          </div>
                        {!! Form::close() !!}
                            
						<div class="text-center text-muted">
							Dont have account yet? <a href="{{ route('register') }}">Sign up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>