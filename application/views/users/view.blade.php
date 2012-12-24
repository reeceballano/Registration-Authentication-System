@layout('layouts.default')

@section('content')
	<h3>{{ $user->username }}'s Profile</h3>

	@if(Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	<p>
		E-mail: {{ $user->email }} <br />
		Created at: {{ $user->created_at }}
	</p>

	@if(Auth::user()->id == $user->id)

		{{ HTML::link_to_route('user_edit', 'Edit Profile', array($user->id)) }} |
		

		{{ Form::open('user/delete', 'DELETE') }}
			{{ Form::hidden('id', $user->id) }}
			{{ Form::submit('Delete Account!', array('style'=>'position: relative;')) }}
		{{ Form::close() }}

	@else 

		<p>Private</p>

	@endif

@endsection