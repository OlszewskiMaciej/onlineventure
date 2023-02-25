<?php

if(isset($_POST['submit'])){
    require_once('conn.php');

	$title = $_POST['title'];
	$text = $_POST['text'];
	$creation_date = date("Y-m-d H:i:s");
	$authors = $_POST['authors'];

	// Insert new news into database
	$stmt = $conn->prepare("INSERT INTO news (title, text, creation_date) VALUES (:title, :text, :creation_date)");
	$stmt->execute([
		':title' => $title,
		':text' => $text,
		':creation_date' => $creation_date
	]);
	$news_id = $conn->lastInsertId();

	// Associate news with selected authors
	foreach ($authors as $author_id) {
		$stmt = $conn->prepare("INSERT INTO news_author (news_id, author_id) VALUES (:news_id, :author_id)");
		$stmt->execute([
			':news_id' => $news_id,
			':author_id' => $author_id
		]);
	}

	$conn = null;

	header("Location: index.php");
	exit;
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Add New One</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Add New One</h1>

	<form method="post" action="add_news.php">
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" required>

		<label for="text">Text:</label>
		<textarea name="text" id="text" rows="8" required></textarea>

		<label for="authors">Authors:</label>
		<select multiple name="authors[]" id="authors" required>

			<?php
				require_once('conn.php');

				$stmt = $conn->query("SELECT * FROM author");

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
				}

				$conn = null;
			?>
		</select>
		<input type="submit" name="submit" value="Save">
	</form>
</body>
</html>