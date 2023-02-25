<?php
require_once('conn.php');

// Delete news author from database
$id = $_GET['id'];
$stmt1 = $conn->prepare("DELETE FROM news_author WHERE news_id=:id");
$stmt1->bindParam(':id', $id);
$stmt1->execute();

// Delete news from database
$stmt2 = $conn->prepare("DELETE FROM news WHERE id=:id");
$stmt2->bindParam(':id', $id);
$stmt2->execute();

$conn = null;

header("Location: index.php");
exit;
