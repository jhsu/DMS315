<?php 

include('database.php');
include('country_model.php');

if ($_GET['code']) {
  $code = $_GET['code'];
  $country = new Country();
  $country = $country->find_by_code($code);
} else {
  $countries = new Country();
  $countries = $countries->all();
}
?>

<?php include('../views/_header.php'); ?>
<?php
if (isset($country)) {?>
<h2><? echo $country->name ?></h2>
<dl>
<?php foreach($country as $attr => $value) { ?>
  <dt><?php echo $attr ?></dt>
  <dd><?php echo $value ?></dd>
<? } ?>
</dl>
<?php
} else { ?>
<h2>Countries</h2>
<table>
  <thead>
	<tr>
	  <th>Continent</th>
	  <th>Region</th>
	  <th>Country</th>
	</tr>
  </thead>
  <tbody>
<?php foreach($countries as $country) { ?>
	<tr>
	  <td><?php echo $country->continent ?></td>
	  <td><?php echo $country->region ?></td>
	  <td><a href="?code=<?php echo $country->code ?>"><?php echo $country->name ?></a></td>
	</tr>
<? } ?>
  <tbody>
</table>
<? } ?>

<?php include('../views/_footer.php'); ?>
