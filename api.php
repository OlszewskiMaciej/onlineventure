<?php
require_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['endpoint'] === 'article') {
        // Get article by some ID
        $article_id = $_GET['id'];
        $sql = "SELECT * FROM news WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$article_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            // Get authors for article
            $authors_sql = "SELECT a.name FROM author a
                            INNER JOIN news_author na ON na.author_id = a.id
                            WHERE na.news_id = ?";
            $authors_stmt = $conn->prepare($authors_sql);
            $authors_stmt->execute([$article_id]);
            $authors = $authors_stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Add authors to article data
            $row['authors'] = $authors;
    
            echo json_encode($row);
        } else {
            echo "News not found";
        }
    }
     elseif ($_GET['endpoint'] === 'author') {
        // Get all articles for given author
        $author_name = $_GET['name'];
        $sql = "SELECT news.* FROM news
                JOIN news_author ON news.id = news_author.news_id
                JOIN author ON news_author.author_id = author.id
                WHERE author.name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$author_name]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($rows) {
            echo json_encode($rows);
        } else {
            echo "No news found for author";
        }
    } elseif ($_GET['endpoint'] === 'top_authors') {
        // Get top 3 authors that wrote the most articles last week
        $last_week = date('Y-m-d', strtotime('-1 week'));
        $sql = "SELECT author.id, author.name, COUNT(*) as article_count FROM author
                JOIN news_author ON author.id = news_author.author_id
                JOIN news ON news_author.news_id = news.id
                WHERE news.creation_date >= ?
                GROUP BY author.id
                ORDER BY article_count DESC
                LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$last_week]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($rows) {
            echo json_encode($rows);
        } else {
            echo "No top authors";
        }
    } else {
        echo "Invalid endpoint";
    }
}

$conn = null;