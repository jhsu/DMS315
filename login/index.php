<?php
include('../database.php');
include('../ar.php');

class User extends AR {
	function find($id) {
	  $query = mysql_query(sprintf("select * from users where id = %s", array($Id)));
	  $user = new User();
	  unset($user->self);
	  foreach(mysql_fetch_assoc($query) as $attr => $value) {
		$user->$attr = $value;
	  }
	  return $user;
	}
}

// sessions
session_start();

?>

<?php include('../views/_header.php'); ?>
<?php include('login.php'); ?>
<?php include('../views/_footer.php'); ?>

