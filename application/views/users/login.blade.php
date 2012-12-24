@layout('layouts.default')

@section('content')
	<h3>Login</h3>

	@if(Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	{{ Form::open('user/login', 'POST') }}

	<p>
		{{ Form::label('username', 'Username: ') }} <br />
		{{ Form::text('username', Input::old('username')) }} <br />

		{{ Form::label('password', 'Password: ') }} <br />
		{{ Form::password('password') }} <br />

		{{ Form::submit('Login') }}
	</p>
	
	{{ Form::close() }}
@endsection