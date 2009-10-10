<?php

class User {
	protected $writable_attrs = array(
	  'username',
	  'email',
	  'crypted_password',
	  'password_salt'
	);	

	function __construct() {
	}

	function create($params) {
		$user = new self;
		if ($params['password']) {
			$user->password_salt = "hello";
			$user->crypted_password = sha1($user->password_salt.$params['password']);
			unset($params['password']);
		}

		$user->login = $params['username'];
		$user->email = $params['email'];
		$fields = array();
		$values = array();

		foreach($user->writable_attrs as $attr) {
		  $fields[] = $attr;
		  $values[] = $user->$attr;
		}

		$fields = implode(",", $fields);
		$values = implode(",", $values);
		mysql_query("insert into users ($fields) values($values)");
		return $user;
	}

	function __set($name, $value) {
		if ($name == 'password') {
			$this->password_salt =(string) sha1(time());
			$this->crypted_password = (string) sha1($this->password_salt.$value);
		} else {
			$this->$name = $value;
		}
	}


	public function authenticate($username, $password) {
	}
}

?>
