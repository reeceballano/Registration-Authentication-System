<?php

class Users_Controller Extends Base_Controller {
	public $restful = true;

	public function get_index() {
		return View::make('users.index')
			->with('title', 'Users List')
			->with('users', User::order_by('id')->paginate(2));
	}

	public function get_view($id) {
		$user = User::where('id', '=', $id)->first();
		
		if(!$user) {
			return Response::error('404');
		} else {
			return View::make('users.view')
				->with('title', $user->username . ' Profile')
				->with('user', $user);
		}
	}

	public function get_new() {
		return View::make('users.new')
			->with('title', 'Create New User');
	}

	public function post_create() {
		$validation = User::validate(Input::all());

		if($validation->fails()) {
			return Redirect::to_route('user_new')
				->with_errors($validation)
				->with_input();
		} else {
			User::create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password')),
					'email' => Input::get('email')
				));

			return Redirect::to_route('user_new')
				->with('message', 'New user has been created successfully!');
		}
	}

	public function get_edit($id) {
		$user = User::where('id', '=', $id)->first();

		if(!$user) {
			return Response::error('404');
		} else {
			return View::make('users.edit')
				->with('title', $user->username . ' - Edit Profile')
				->with('user', $user);
		}
		
	}

	public function put_update() {
		$id = Input::get('id');

		$validation = User::validate(Input::all(), $id);

		if($validation->fails()) {
			return Redirect::to_route('user_edit', $id)
				->with_errors($validation)
				->with_input();
		} else {
			User::update($id, array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password')),
					'email' => Input::get('email')
				));

			return Redirect::to_route('user_view', $id)
				->with('message', 'Profile Successfully updated!');
		}
	}

	public function delete_destroy() {
		$id = Input::get('id');

		User::find($id)->delete();
		
		return Redirect::to_route('home')
			->with('message', 'User successfully deleted!');
	}

	public function get_login() {
		return View::make('users.login')
			->with('title', 'Login!');
	}

	public function post_validatelogin() {
		$userdata = array('username'=>Input::get('username'), 'password'=>Input::get('password'));
		if(Auth::attempt($userdata)) {
			return Redirect::to_route('home')
				->with('title', ' Welcome Back!')
				->with('message', 'Successfully Login!');
		} else {
			return Redirect::to_route('login')
				->with('message', 'Username or password is invalid!');
		}
	}
}