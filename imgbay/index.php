<?php 
/*
 * IMGbay
 * img vs img
 * images have rank
 * some sort of numeric value
 */

require('../config/database.php');
require('user.php');

// start session
session_start();
require('helpers.php'); // some helpers require sessions

// handel REST requests


// get '/'
if (online() && !$_GET['action'] !== 'logout' && !$_POST) {
  $user = current_user();
}

// post, register user
if ($_POST['action'] == 'register') {
  $user = User::create($_POST);
}

// login
if ($_POST['action'] == 'login') {
  $user = User::authenticate($_POST['username'], $_POST['password']); 
}

// logout
if ($_GET['action'] == 'logout') {
  logout();
  header("Location: ".$base_url);
  die();
}

// logout

// login

/*
if ($_POST) { // if logged in
  $user = User::authenticate($_POST['username'], $_POST['password']); 
} else { // GET request
  if (online()) {
	$user = User::find($_SESSION['user_id']); 
	if ($_GET['action'] == 'logout') {
		$_SESSION['user_id'] = NULL;
	}
  }
}
 */

?>

<?php include('views/_header.php');?>

<?php include('views/_navi.php');?>

<div id="login">
<?php if(online()) { ?>
<h2>Welcome back, <a href="<?= $base_url ?>/photos.php"><?= $user->username ?></a>!</h2>
<?php } else { ?>
  <?php include('views/_login.php');?>
<?php } ?>
</div>

<?php// include('views/_debug.php'); ?>

<?php include('views/_footer.php');?>
