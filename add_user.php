<?php
// Database Connection.
include 'db.php';

// form validation
$error = '';
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone_nr = $_POST['phone_nr'];

	if(empty($first_name) || empty($last_name) || empty($email) || empty($phone_nr)) {
		$error = 'Please fill out all fields';
	} else {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = 'Please enter a valid email';
		} else {

			// prepared statement
			$stmt = $pdo->prepare("INSERT INTO users (first_name,last_name,email,phone_nr) VALUES (:first_name, :last_name, :email, :phone_nr)");

			// insert record
			$stmt->execute([
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'phone_nr' => $phone_nr,
			]);

			// redirect user back to index page
			header("location: index.php");
		}
	}
}

include 'head.php';

// displays error message
if($error !== '') :
	?>
	<div class="alert alert-danger text-center" role="alert">
		<?php echo $error ?>
	</div>
	<?php
endif;
?>

<h1>HERE BE ADD USER</h1>

<form method="POST" action="./add_user.php">
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" class="form-control" id="first_name" name="first_name">
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" class="form-control" id="last_name" name="last_name">
	</div>
	<div class="form-group">
		<label for="email">Email address</label>
		<input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
		<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
	</div>
	<div class="form-group">
		<label for="phone_nr">Phone Nr</label>
		<input type="number" class="form-control" id="phone_nr" name="phone_nr">
	</div>

	<button name="add_user" type="submit" class="btn btn-primary">Add User</button>
</form>

<?php
include 'foot.php';
