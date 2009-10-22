<?php 

require('../config/database.php');
require('user.php');
require('photo.php');

// start session
session_start();
require('helpers.php'); // some helpers require sessions

// must be authorized to view this page
must_be_authorized();

$photos = Photo::top();
?>

<?php include('views/_header.php');?>

<?php include('views/_navi.php');?>

<ol class="photos">
<h2>Top Photos</h2>
<?php foreach($photos as $photo) { ?>
<li><a href="/imgbay/photos/<?= $photo->filename ?>"><img src="/imgbay/photos/<?= $photo->thumbnail ?>" /></a><br />
<caption><?= $photo->score ?></caption>
</li>
<?php } ?>
</ol>

<?php include('views/_footer.php');?>
