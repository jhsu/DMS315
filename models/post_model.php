<?php

class Post extends AR {
	// title, body, created_at
	protected $table_name = 'posts';
	var $title;
	var $body;
	var $created_at;

	public function __construct(/* array */) {
		$args = fun_get_args();
		foreach($attr as $a) {
		   $this->self->$a = $args[$a];
		}
	}
}

?>
