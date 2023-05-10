<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Page</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="/admin/fonts/all.min.css">
	<link rel="stylesheet" href="/admin/css/adminlte.min.css"> </head>

<body class="hold-transition register-page">

	<div class="register-box">
		<div class="card card-outline card-primary">
			<div class="card-header text-center"><b>Blog Demo</b></div>

            <div class="container mt-2">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>

			<div class="card-body">
				<p class="login-box-msg">Register a new membership</p>
				<form action="{{ route('register.store') }}" method="post">
                    @csrf


					<div class="input-group mb-3">
						<input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
						<div class="input-group-append">
							<div class="input-group-text"> <span class="fas fa-user"></span> </div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
						<div class="input-group-append">
							<div class="input-group-text"> <span class="fas fa-envelope"></span> </div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="password" class="form-control" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text"> <span class="fas fa-lock"></span> </div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
						<div class="input-group-append">
							<div class="input-group-text"> <span class="fas fa-lock"></span> </div>
						</div>
					</div>



					<div class="row">
						<div class="col-4 offset-8">
							<button type="submit" class="btn btn-primary btn-block">Register</button>
						</div>
					</div>
				</form>

                <a href="#" class="text-center">I already have a membership</a> </div>
		</div>
	</div>
	<script src="/admin/js/jquery.min.js"></script>
	<script src="/admin/js/bootstrap.bundle.min.js"></script>
	<script src="/admin/js/adminlte.min.js"></script>
</body>

</html>
