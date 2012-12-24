@layout('layouts.default')

@section('content')
	<h2>User's List</h2>

	@if(Auth::check())
		<span>Welcome {{ Auth::user()->username }}</span>
	@else
		<span>Welcome Guess, Please {{ HTML::link_to_route('user_new', 'Register') }} </span>
	@endif

	@if(Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif
	
	<ul>
		@foreach($users->results as $user)
			<li>
				{{ HTML::link_to_route('user_view', $user->username, array($user->id))}}
			</li>
		@endforeach
	</ul>

	{{ $users->links() }}

	<hr>

	{{ HTML::link_to_route('user_new', 'Create New User') }}
@endsection