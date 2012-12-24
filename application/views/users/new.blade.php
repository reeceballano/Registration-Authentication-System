@layout('layouts.default')

@section('content')
	<h3>Create New User</h3>

	@if($errors->has())
		{{ $errors->first('username', '<li>:message</li>') }}
		{{ $errors->first('password', '<li>:message</li>') }}
		{{ $errors->first('email', '<li>:message</li>') }}
	@endif

	@if(Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	{{ Form::open('user/create', 'POST') }}

	<p>
		{{ Form::label('username', 'Username: ') }} <br />
		{{ Form::text('username', Input::old('username')) }} <br />

		{{ Form::label('password', 'Password: ') }} <br />
		{{ Form::password('password') }} <br />

		{{ Form::label('email', 'E-mail: ') }} <br />
		{{ Form::text('email', Input::old('email')) }} <br />

		{{ Form::submit('Create') }}
	</p>

	{{ Form::close() }}
@endsection