<?php

class User Extends Eloquent {
	public static $table = 'users';

	public static function validate($inputs, $id = null) {
		$rules = array(
				'username' 	=> "required|unique:users,username, {$id}",
				'password' 	=> 'required|min:6',
				'email' 	=> "required|min:2"
			);

		return Validator::make($inputs, $rules);
	}
}