<?php

if(isset($_POST['submit'])){
    require_once('conn.php');

	$name = $_POST['name'];

	// Insert new author into database
	$stmt = $conn->prepare("INSERT INTO author (name) VALUES (:name)");
	$stmt->execute([
		':name' => $name
	]);

	$conn = null;

	header("Location: index.php");
	exit;
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Add New Author</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Add New Author</h1>

	<form method="post" action="add_author.php">
		<label for="title">Author name:</label>
		<input type="text" name="name" id="name" required>

		<input type="submit" name="submit" value="Save">
	</form>
</body>
</html>