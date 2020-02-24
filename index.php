<?php
// Database Connection.
include 'db.php';
session_start();

// form validation
$message = '';
if(isset($_POST['login'])) {

	if(empty($_POST['email']) || empty($_POST['password'])) {
		$message = 'ALL FIELDS MUST BE FILLED';
	} else {
		$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
		$stmt->execute([
			'email' => $_POST['email'],
			'password' => $_POST['password'],
		]);

		$count = $stmt->rowCount();
		$admin = $stmt->fetchAll();

		if($count > 0) {
			if(intval($admin[0]['is_admin']) === 1) {
				$_SESSION['email'] = $_POST['email'];
				header('location: logged_in.php');
			}
		} else {
			$message = 'YOU BE NO ADMIN!!';
		}
	}
}

include 'head.php';
?>

<h1>HERE BE HOME</h1>

<h2>Admin Loggin:</h2>
<?php
// displays error message
if($message !== '') :
	?>
	<div class="alert alert-danger text-center" role="alert">
		<?php echo $message ?>
	</div>
	<?php
endif;
?>

<form method="POST">

	<div class="form-group">
		<label for="email">Email</label>
		<input type="text" class="form-control" id="email" name="email">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" name="password">
	</div>

	<input type="submit" name="login" class="btn btn-info" value="Login" />
</form>

<?php
include 'foot.php';
