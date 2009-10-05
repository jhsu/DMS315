<?php

function current_user() {
	if ($_COOKIE['user_id']) {
		$user = new User();
		$id = $_COOKIE['user_id'];
		$user = $user->find($id);
		return $user;
	} else {
		return false;
	}
}

function require_login() {
	if (current_user()) {
		// redirect to login
	} else {
		return true;
	}
}

?>
