@extends('frontEnd.main')
@section('content')
<!-- Begin FB's Breadcrumb Area -->
<div class="breadcrumb-area pt-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-content">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li class="active">Login/ Register</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- FB's Breadcrumb Area End Here -->
<!-- Begin Login Content Area -->
<div class="page-section pt-60 pb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
				<!-- Login Form s-->
				<form method="POST" action="{{ url('/customer-login') }}" >
					{{ csrf_field() }}
					@if($errors ->any())
					<div class="alert alert-danger m-b-0">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						@foreach($errors->all() as $error)
						<div>{{ $error }}</div>
						@endforeach
					</div>
					@endif
                                <div class="login-form">
                                    <h4 class="login-title">Login</h4>
                                    <div class="row">
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Email Address*</label>
                                            <input class="mb-0" type="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                            <div class="md-form-group  {{ $errors->has('email') ? ' has-error' : '' }}">
								</div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Password</label>
                                            <input class="mb-0" type="password" name="password" placeholder="Password">
                                            <div class="md-form-group  {{ $errors->has('password') ? ' has-error' : '' }}">
									</div>
									@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                                <input name="remember_me" type="checkbox" id="remember_me">
                                                <label for="remember_me">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                            <a href="#"> Forgotten pasward?</a>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="register-button mt-0">Login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
			<form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                @if ($errors->has('name'))
                    <div class="alert alert-warning">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-warning">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-warning">
                        {{ $errors->first('password') }}
                    </div>
                @endif
							<div class="login-form">
								<h4 class="login-title">Register</h4>
								<div class="row">
									<div class="col-md-12 col-12 mb-20">
	<label>First Name</label>
	<input class="mb-0" type="text" placeholder="Full Name" name="name" value="{{ old('name') }}" required autofocus>
									</div>
									
									<div class="col-md-12 mb-20">
										<label>Email Address*</label>
										<input class="mb-0" type="email" placeholder="Email Address" name="email" value="{{ old('email') }}" required>
									</div>
									<div class="col-md-6 mb-20">
										<label>Password</label>
										<input class="mb-0" type="password" placeholder="Password" name="password" required>
									</div>
									<div class="col-md-6 mb-20">
										<label>Confirm Password</label>
										<input class="mb-0" type="password" placeholder="Confirm Password" name="password_confirmation" required>
									</div>
									<div class="col-12">
										<button type="submit" class="register-button mt-0">Register</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Login Content Area End Here -->




		@endsection