<?php

include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = intval($_GET['id']);


    $sql = "DELETE FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Article deleted successfully.";
    } else {
        $_SESSION['success'] = "Failed to delete the article.";
    }

    $stmt->close();
    $conn->close();

    header("Location: read_articles.php");
    exit();
}
?>
