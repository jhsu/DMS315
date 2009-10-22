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

// must be authorized to view this page
must_be_authorized();

if ($_POST['delete']) {
  Photo::delete_all();
}

$photos = current_user()->photos();

?>

<?php include('views/_header.php');?>

<?php include('views/_navi.php');?>

<form action="<?= $base_url ?>/upload.php" method="post" enctype="multipart/form-data">
<fieldset>
  <label for="upload[file]">File</label>
  <input type="file" id="upload[file]" name="photo" />
  <button type="submit">upload</button>
</fieldset>
</form>


<ul class="photos">
<?php foreach($photos as $photo) { ?>
<li>
<a href="/imgbay/photos/<?= $photo->filename ?>">
<img src="/imgbay/photos/<?= $photo->thumbnail ?>" />
</a>
</li>
<?php } ?>
</ul>

<form action="" method="post" onsubmit="if(confirm('delete all your photos?')) { } else { return false; }">
<input type="submit" name="delete" value="Delete All" />
</form>

<?php include('views/_footer.php');?>
