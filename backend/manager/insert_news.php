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
$error='';
if (isset($_POST['submit'])) {
    $avatars = $_FILES['avatar'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $_SESSION['$title_news']=$title;
    $_SESSION['description_news']=$description;
    $_SESSION['content_news']=$content;
    $_SESSION['status_news']=$status;

    if ($avatars['error'] == 0) {
        $extension = pathinfo($avatars['name'],PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        $allows = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($extension, $allows)) {
            $error = 'File upload phải là ảnh';
            $_SESSION['error_add_news'] = $error;
            header('Location: add_news.php');
        }
        $size_b = $avatars['size'];
        $size_mb = $size_b / 1024 / 1024;
        if ($size_mb > 2) {
            $error = 'File upload ko đc vượt quá 2 Mb';
            $_SESSION['error_add_news'] = $error;
            header('Location: add_news.php');
        }
    }
    $avatars_name=$avatars['name'];

    if (empty($error)) {
        $sql = "INSERT INTO news (avatars,title, description, content, status) VALUES ('$avatars_name','$title', '$description', '$content', '$status')";
        mysqli_query($conn,$sql);
        header("Location: home.php");
        exit();
    }
}
$conn->close();
?>