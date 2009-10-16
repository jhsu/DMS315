<?php
class User {
	protected $writable_attrs = array(
	  'username',
	  'email',
	  'crypted_password',
	  'password_salt'
	);	

	protected $attrs = array(
	  'id',
	  'username',
	  'email',
	  'crypted_password',
	  'created_at',
	  'updated_at',
	);	

	function __construct() {
	}

	function create($params) {
		$user = new self;
		if ($params['password']) {
			$user->password = trim($params['password']);
			unset($params['password']);
		}

		$user->username = "'".strtolower(trim($params['username']))."'";
		$user->email = "'".trim($params['email'])."'";
		$fields = array();
		$values = array();

		foreach($user->writable_attrs as $attr) {
		  $fields[] = $attr;
		  $values[] = $user->$attr;
		}

		$fields = implode(",", $fields);
		$values = implode(",", $values);
		$query = mysql_query("insert into users (".$fields.") values(".$values.")") or die("could not create" . mysql_error());
		$result_user = mysql_fetch_array($query);
		
		return $result_user;
	}

	function __set($name, $value) {
		if ($name == 'password') {
			$value = trim($value);
			$this->password_salt = "hello";
			$this->crypted_password = "'".sha1($this->password_salt.$value)."'";
			$this->password_salt = "'".$this->password_salt."'";
		} else {
			$this->$name = $value;
		}
	}


	public function authenticate($username, $password) {
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);

		$query = sprintf("select * from users where username='%s' limit 1", $username);
		$query = mysql_query($query);
		$result = mysql_fetch_assoc($query);
		$user = new self();
		foreach($user->attrs as $attr) {
			$user->$attr = $result[$attr];
		}
		if ($user->crypted_password == sha1($user->password_salt.$password)) {
		  unset($user->password_salt);
		  $_SESSION['user_id'] = $user->id;
		  // setcookie('user_id', (string) $user->id);
		  return $user;
		} else {
		  return false;
		}
	}

	public function find($id) {
		$query = mysql_query("select * from users where id=".(int) $id." limit 1");
		$result = mysql_fetch_assoc($query);
		$user = new self();
		foreach($user->attrs as $attr) {
			$user->$attr = $result[$attr];
		}
		return $user;
	}

	public function update($attrs) {
		$user = self();
		foreach($attrs as $attr => $value) {
		  if(in_array($attr, $user->writable_attrs)) {
		  }
		}
		return $user;
	}

}

?>
