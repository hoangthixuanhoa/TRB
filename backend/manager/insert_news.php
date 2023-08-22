<?php
session_start();

//Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "emo";
$password = "123456EmoR2";
$dbname = "emo";
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $sql = "INSERT INTO news (title, description, content, status) VALUES ('$title', '$description', '$content', '$status')";
    mysqli_query($conn,$sql);
    header("Location: home.php");
    exit();
}
$conn->close();
?>