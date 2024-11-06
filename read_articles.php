<?php
// Include the database connection
include 'db_connection.php';

// Start the session
session_start();

// Fetch all articles from the database
$sql = "SELECT * FROM article";
$result = $conn->query($sql);
$articles = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WriteWave - Read Articles</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            padding: 10px 20px;
        }
        .navbar-brand {
            text-decoration: none;
            color: rgb(24, 78, 122);
        }
        .navbar-nav {
            display: flex;
            gap: 20px;
        }
        .nav-link {
            text-decoration: none;
            color: rgb(24, 78, 122);
            font-size: 16px;
        }
        .nav-link.active {
            font-weight: bold;
        }
        h2 {
            text-align: center;
            color: rgb(24, 78, 122);
            margin-bottom: 20px;
        }
        .articles-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .article-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .article-title {
            font-size: 20px;
            font-weight: bold;
            color: rgb(24, 78, 122);
            margin-bottom: 10px;
        }
        .article-author {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
        .article-content {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }
        .delete-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- Display success message if set -->
    <?php if (isset($_SESSION['success'])): ?>
        <div style="color: green; text-align: center; margin-bottom: 15px;">
            <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <nav class="navbar">
        <a class="navbar-brand" href="/">
            <h1>WriteWave</h1>
        </a>
        <div class="navbar-nav">
            <a class="nav-link active" href="read_articles.php"><h3>Read Articles</h3></a>
            <a class="nav-link" href="write_article.html"><h3>Write Article</h3></a>
        </div>
    </nav>
    <hr />

    <h2>Read Articles</h2>

    <div class="articles-container">
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <div class="article-card">
                    <div class="article-title"><?php echo htmlspecialchars($article['title']); ?></div>
                    <div class="article-author">by <?php echo htmlspecialchars($article['author']); ?></div>
                    <div class="article-content"><?php echo htmlspecialchars(substr($article['body'], 0, 100)); ?>...</div>
                    <form method="POST" action="delete_article.php?id=<?php echo $article['id']; ?>">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No articles found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
