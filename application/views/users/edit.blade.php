@layout('layouts.default')

@section('content')
	
	<!-- check if there is an active session -->
	@if(Auth::check())

		<!-- if there is an active session, then check if the active user is equal to the use id -->

		@if(Auth::user()->id == $user->id)

			<h3>Update Profile!</h3>

			@if($errors->has())
				{{ $errors->first('username', '<li>:message</li>') }}
				{{ $errors->first('password', '<li>:message</li>') }}
				{{ $errors->first('email', '<li>:message</li>') }}
			@endif

			@if(Session::has('message'))
				<p>{{ Session::get('message') }}</p>
			@endif

			{{ Form::open('user/update', 'PUT') }}

			<p>
				{{ Form::label('username', 'Username: ') }} <br />
				{{ Form::text('username', $user->username) }} <br />

				{{ Form::label('password', 'Password: ') }} <br />
				{{ Form::password('password') }} <br />

				{{ Form::label('email', 'E-mail: ') }} <br />
				{{ Form::text('email', $user->email) }} <br />

				{{ Form::hidden('id', $user->id) }}

				{{ Form::submit('Update') }}
			</p>

			{{ Form::close() }}

		@else
			<p>Private</p>
		@endif

	@else

		{{ Redirect::to_route('login') }}

	@endif
		
@endsection