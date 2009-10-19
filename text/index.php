<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>PHP for DMS</title>
  <link type="text/css" rel="stylesheet" href="../style.css" media="screen" />
  <script type="text/javascript" src="../jquery.min.js"></script>
</head>
<body>

<?php 

$nouns = array("Barack Obama", "Sarah Palin", "Stephen Colbert", "Chris Brown", "Kanye West");
$verbs = array("hates","punched","smacked", "beat", "jumped","teases");

function paragraph() {
	global $nouns;
	global $verbs;

	$sentence = "";
	$i = 0;
	while($i <= 3) {
		$noun = ucwords($nouns[rand(0,count($nouns)-1)]);
		$verb = $verbs[rand(0,count($verbs)-1)];
		$object = $nouns[rand(0,count($nouns)-1)];
		$sentence.= "$noun $verb $object. ";
		$i++;
	}
	return $sentence;
}

function entry() {
	$paragraphs = "";
	$i = 0;
	while($i <= 4) {
	  $paragraphs .= "<p>" . paragraph() . "</p>";
	  $i++;
	}

	return $paragraphs;
}

$random_text = array(
	'title' => 'Random Text',
	'body'  => entry()
	);

$posts = array($random_text);

if ($_POST) {
	$title = $_POST['new_post_title'];
	$body = $_POST['new_post_body'];
	$posts[] = array(
	  'title' => $title,
	  'body' => $body
	);
}
?>

<div id="container">
<h1><?php echo "Joseph Hsu" ?></h1>


<h2>Forms</h2>
<div class="post_body">
<form action="" id="new_post" method="post">
  <fieldset><legend><a href="" onclick="return false;">New Post</a></legend>
	<p>
	  <label for="new_post_title">Title</label>
	  <input type="text" id="new_post_title" name="new_post_title" />
	</p>
	<p>
	  <label for="new_post_body">Body</label>
	  <textarea id="new_post_body" name="new_post_body"></textarea>
	</p>
	<p>
	  <input type="submit" value="Create" />
	</p>
  </fieldset>
</form>
</div>




<div class="posts">
<?php foreach(array_reverse($posts) as $post) { ?>
<h2><?php echo $post['title'] ?></h2>
<div class="post_body">
  <?php echo $post['body'] ?>
</div>
<?php } ?>


</div>

</div><!-- /#container -->
<script type="text/javascript">
$(document).ready(function() {
  $('#new_post p').hide();
  $('#new_post legend a').click(function() {
	$('#new_post p').toggle();
	$('#new_post #new_post_title').focus();
  });
});
</script>
</body>
</html>
