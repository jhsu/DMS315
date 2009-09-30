<?php 
include('../database.php');
include('../ar.php');

// Models
class Enemy extends AR {
	const table_name = 'enemies';
	const primary_key = 'id';

	public function __construct() {
		unset($this->self);
	}

	public function all() {
		$result = mysql_query("select * from enemies order by rank ASC");
		$results = array();
		while($row = mysql_fetch_assoc($result)) {
			$_this = new Enemy();
			foreach($row as $attr => $value) {
				$_this->$attr = $value;
			}
			$results[] = $_this; 
		} 
		return $results;
	}

	public function find($id) {
		$id = mysql_real_escape_string($id);
		$_this = new Enemy();
		$result = mysql_query("select * from ". self::table_name ." where ". self::primary_key ."='$id' limit 1");
		$result = mysql_fetch_array($result, MYSQL_ASSOC);
		foreach(get_object_vars($result) as $attr => $value ) $_this->$attr = $value;
		return $_this;
	}

	public function create($attr) {
		if (is_array($attr)) {
			$result = mysql_query(sprintf("insert into enemies (rank, name, description) values(rank+1, '%s', '%s')", $attr['name'], $attr['description']));
			unset($_this->self);
			foreach($attr as $attribute => $value) {
				$_this->$attribute = $value;
			}
		}
		return $_this;
	}
}

// Controller

  // Create
if ($_POST) {
	$enemy = Enemy::create($_POST);
}

  // Index
$enemies = Enemy::all();


// Views
?>

<?php include('../views/_header.php'); ?>

<h2>Nixon's Enemies</h2>
<ol class="ranking">
<?php foreach($enemies as $enemy) { ?>
  <li>
	<h3><span><?php echo $enemy->rank ?></span>
	<?php print($enemy->name) ?></h3>
	<p><?php echo $enemy->description ?></p>
  </li>
<?php } ?>
</ol>

<form action="./" method="post">
  <fieldset><legend>Add Enemy</legend>
	<p>
		<label for="name">Name</label>
		<input type="text" name="name" />
	</p>
	<p>
	<label for="description">Description</label>
	<textarea name="description"></textarea>
	</p>
	<button type="submit">Add</button>
  </fieldset>
</form>

<?php include('../views/_footer.php'); ?>
