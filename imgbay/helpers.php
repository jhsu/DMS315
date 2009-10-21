<?php

$env = array(
	'app_url' => 'http://jhsu.no-ip.org:8066/imgbay'
);

$base_url = $env['app_url'];
$photos_dir = 'photos';

function current_user() {
  if (online()) {
  	$user = User::find((int) $_SESSION['user_id']);
  	return $user;
  } else {
  	return NULL;
  }
}

function online() {
  if ($_SESSION['user_id']) {
  	return true;
  } else {
  	return false;
  }
}

function must_be_authorized() {
  global $base_url;
  if (!online()) {
	header("Location: $base_url", true, 302);
	print("Location: $base_url");
	return false;
  }
}

function logout() {
  $_SESSION['user_id'] = NULL;
}

?>
