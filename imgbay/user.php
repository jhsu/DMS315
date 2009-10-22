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

		foreach($params as $attr => $value) {
		  $user->$attr = trim($value);
		}
		$fields = array('username','email','password_salt','crypted_password');
		$values = array($user->username, $user->email, $user->password_salt, $user->crypted_password);

		$fields = implode(",", $fields);
		$values = "'".implode("','", $values)."'";
		$query = sprintf("insert into users (%s) values(%s)", $fields, $values);
		$query = mysql_query($query) or die("could not create" . mysql_error());
		
		return $result_user;
	}

	function __set($name, $value) {
	  if ($name == 'password') {
	  	$value = trim($value);
	  	$this->password_salt = "hello";
	  	$this->crypted_password = sha1($this->password_salt.$value);
	  	unset($this->password);
	  } else {
	  	$this->$name = $value;
	  }
	}


	public function authenticate($username, $password) {
	  $username = trim($username);
	  $password = trim($password);

	  $query = sprintf("select * from users where username='%s' limit 1", $username);
	  $query = mysql_query($query) or die('fail');

	  if (mysql_num_rows($query) == 0) {
		return false;
	  }
      $results = mysql_fetch_assoc($query);
      $user = new self();
      foreach($results as $attr => $value) {
      	$user->$attr = $value;
      }

      if ($user->crypted_password == sha1($user->password_salt.$password)) {
      	unset($user->password_salt);
      	unset($user->crypted_password);
      	$_SESSION['user_id'] = $user->id;
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

	public function photos() {
	  $result = mysql_query("select * from photos where user_id ='".$this->id."'");
	  $photos = array();

	  if (mysql_num_rows($result) == 0) {
	  } else {
		while($photo = mysql_fetch_assoc($result)) {
			$photos[] = new Photo($photo);
		}
	  }
	  $this->photos = array_reverse($photos);
	  return $this->photos;
	}


}

?>
