<?php
include 'db_connection.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);


    $sql = "INSERT INTO article (title, author, body) VALUES ('$title', '$author', '$body')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>Data saved successfully!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }


    $conn->close();
}
?>
