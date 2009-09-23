
<?php 
include('ar.php');
$models = glob('models/*.php');
foreach( $models as $file) {
	include($file);
}

$countries = new Country();
$countries = $countries->all();
?>

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
	  <td><?php echo $country->name ?></td>
	</tr>
<? } ?>
  <tbody>
</table>

