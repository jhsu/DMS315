<ul id="navi">
  <li><a href="<?= $base_url ?>/">Home</a></li>
<?php if (online()) { ?>
  <li><a href="<?= $base_url ?>/photos.php">Photos</a></li>
  <li><a href="<?= $base_url ?>/?action=logout">Logout</a></li>
<?php } else { ?>
  <li><a href="">Login</a></li>
<?php } ?>
</ul>
