<!DOCTYPE html>
<html>
<head>
    <title>News Articles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
<a href="http://localhost/onlineventure/add_news.php">Add news</a>
<a href="http://localhost/onlineventure/add_author.php">Add author</a>
<h1>News</h1>
<table>
    <tr>
        <th>Title</th>
        <th>Text</th>
        <th>Creation Date</th>
        <th>Authors</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php
        require_once('conn.php');

        $stmt = $conn->prepare("SELECT * FROM news");
        $stmt->execute();

        // Loop through query results and display each news in a table row
        while ($row = $stmt->fetch()) {
            // Get author names for news
            $author_stmt = $conn->prepare("SELECT name FROM author INNER JOIN news_author ON author.id = news_author.author_id WHERE news_author.news_id = ?");
            $author_stmt->execute([$row['id']]);
            $author_names = array();
            while ($author_row = $author_stmt->fetch()) {
                $author_names[] = $author_row['name'];
            }

            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['text'] . "</td>";
            echo "<td>" . $row['creation_date'] . "</td>";
            echo "<td>" . implode(", ", $author_names) . "</td>";
            echo "<td><a href='edit_news.php?id=" . $row['id'] . "'>Edit</a></td>";
            echo "<td><a href='delete_news.php?id=" . $row['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }

        $conn = null;
    ?>
</table>
</main>
</body>
</html>