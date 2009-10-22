<?php 

require('../config/database.php');
require('user.php');
require('photo.php');

// start session
session_start();
require('helpers.php'); // some helpers require sessions

// must be authorized to view this page
must_be_authorized();

if ($_POST) {
  $photo = Photo::find($_POST['id']);
  $photo->vote();
}

$photos = Photo::random_vs();
?>

<?php include('views/_header.php');?>

<?php include('views/_navi.php');?>

<h2>Vote on a Photo</h2>
<?php foreach($photos as $photo) { ?>
<div class="versus_photo">
  <a href="/imgbay/photos/<?= $photo->filename ?>" onclick="window.open(this.href); return false;"><img src="/imgbay/photos/<?= $photo->thumbnail ?>" /></a>
  <form action="" method="post">
	<input type="hidden" name="id" value="<?= $photo->id ?>" />
	<button type="submit">Vote for this</button>
  </form>
</div>
<?php } ?>

<?php include('views/_footer.php');?>
