<?php
require_once('conn.php');

// Get news and author data from database
$id = $_GET['id'];
$article_query = $conn->prepare("SELECT * FROM news WHERE id=:id");
$article_query->bindParam(':id', $id, PDO::PARAM_INT);
$article_query->execute();
$authors_query = $conn->query("SELECT * FROM author");

// Get existing news data
$article_data = $article_query->fetch();
$title = $article_data['title'];
$text = $article_data['text'];
$author_ids = array();

// Get selected author ID
$selected_authors_query = $conn->prepare("SELECT author_id FROM news_author WHERE news_id=:id");
$selected_authors_query->bindParam(':id', $id, PDO::PARAM_INT);
$selected_authors_query->execute();
while ($author = $selected_authors_query->fetch()) {
    $author_ids[] = $author['author_id'];
}

if(isset($_POST['submit'])){
    $new_title = $_POST['title'];
    $new_text = $_POST['text'];
    $new_author_ids = isset($_POST['authors']) ? $_POST['authors'] : array();

    // Update article data in database
    $update_query = $conn->prepare("UPDATE news SET title=:new_title, text=:new_text WHERE id=:id");
    $update_query->bindParam(':new_title', $new_title);
    $update_query->bindParam(':new_text', $new_text);
    $update_query->bindParam(':id', $id, PDO::PARAM_INT);
    $update_query->execute();

    // Delete existing author associations from database
    $delete_query = $conn->prepare("DELETE FROM news_author WHERE news_id=:id");
    $delete_query->bindParam(':id', $id, PDO::PARAM_INT);
    $delete_query->execute();

    // Add author associations to database
    foreach ($new_author_ids as $author_id) {
        $insert_query = $conn->prepare("INSERT INTO news_author (news_id, author_id) VALUES (:id, :author_id)");
        $insert_query->bindParam(':id', $id, PDO::PARAM_INT);
        $insert_query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $insert_query->execute();
    }

    header("Location: index.php");
    exit;
}

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Edit</h1>
<form method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>" required>

    <label for="text">Text:</label>
    <textarea name="text" id="text" rows="8" required><?php echo htmlspecialchars($text); ?></textarea>

    <label for="authors">Authors:</label>
	<select name="authors[]" id="authors" multiple required>
		<?php while ($author = $authors_query->fetch()): ?>
			<option value="<?php echo $author['id']; ?>" <?php if (in_array($author['id'], $author_ids)) echo 'selected'; ?>><?php echo $author['name']; ?></option>
		<?php endwhile; ?>
	</select>
        
	<input type="submit" name="submit" value="Save">
</form>
</body>
</html>