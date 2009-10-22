<?php 
/*
 * IMGbay
 * img vs img
 * images have rank
 * some sort of numeric value
 */

require('../config/database.php');
require('user.php');
require('photo.php');

// start session
session_start();
require('helpers.php'); // some helpers require sessions

// handel REST requests


// get '/'
if (online() && !$_GET['action'] !== 'logout' && !$_POST) {
  $user = current_user();
}

// post, register user
if ($_POST['register']) {
  $user = User::create($_POST['register']);
}

// login
if ($_POST['login']) {
  $creds = $_POST['login'];
  $user = User::authenticate($creds['username'], $creds['password']); 
}

// logout
if ($_GET['action'] == 'logout') {
  logout();
  header("Location: ".$base_url);
  die();
}


// view user
if ($_GET['user']) {
  $photos = Photo::find_by_username($_GET['user']);
}


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

<?php if ($photos) { ?>
<h2><?= $_GET['user'] ?>'s photos</h2>
<ul class="photos">
<?php foreach($photos as $photo) { ?>
<li><a href="/imgbay/photos/<?= $photo['filename'] ?>"><img src="/imgbay/photos/<?= $photo['thumbnail'] ?>" /></a></li>
<?php } ?>
<ul>
<?php } ?>
<?php// include('views/_debug.php'); ?>

<?php include('views/_footer.php');?>
