<?php
// Database Connection.
include 'db.php';
session_start();

include 'head.php';
if(isset($_SESSION["email"])) {
	$stmt = $pdo->prepare("SELECT * FROM users");
	$stmt->execute();
	$users = $stmt->fetchAll();

	?>
	<h1>HERE BE ADMIN AREA</h1>

	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">First Name</th>
				<th scope="col">Last Name</th>
				<th scope="col">E-Mail</th>
				<th scope="col">Phone Nr</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($users as $user): ?>
				<tr>
					<th scope="row"><?php echo $user['id'] ?></th>
					<td><?php echo $user['first_name'] ?></td>
					<td><?php echo $user['last_name'] ?></td>
					<td><?php echo $user['email'] ?></td>
					<td><?php echo $user['phone_nr'] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<?php
} else {
	header("location: index.php");
}
include 'foot.php';
