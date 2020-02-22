<?php
include 'credentials.php';

// Setting up a PDO connection
$dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME;
try {
	$pdo = new PDO($dsn, DB_USER_NAME, DB_PASSWORD);
} catch(PDOException $e) {
	echo $e->getMessage();
	exit;
}

return $pdo;
