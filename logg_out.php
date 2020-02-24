<?php
session_start();

if(isset($_SESSION["email"])) {
	session_destroy();
	header("location:./index.php");
} else {
	include 'head.php';
	?>
		<h1>YOU ARE NOT LOGGED IN</h1>
	<?php
}
include 'foot.php';

