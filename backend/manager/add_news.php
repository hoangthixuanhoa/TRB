<?php
// Gọi session_start() để bắt đầu phiên làm việc
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION["ma_id"])) {
    // Nếu không có phiên làm việc, chuyển hướng người dùng đến trang đăng nhập
    header("Location: ../accounts/login.php");
    exit();
}

// Kết nối đến cơ sở dữ liệu (chú ý thay đổi thông tin kết nối phù hợp với máy bạn)
$servername = "localhost";
$username = "emo";
$password = "123456EmoR2";
$dbname = "emo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script>
        function changeWeb(){
            window.location.href ='add_news.php';
        }
    </script>
</head>
<body>
    <div id="logo">
        <img>
    </div>
    <div id='body'>
        <header>
            <ul id="menu-ul">
                <li><a class="menu-content" id="home" href="home.php">Trang chủ</a></li>
                <li><a href="../quanly/quanly_users.php">Người dùng</a></li>
                <li><a class="menu-content" id="pro" href="../accounts/profile.php">Pro5</a></li>
            </ul>
        </header>
        <main id="home-container">
            <h3>Thêm bài viết</h3>
                <form method="post" action='insert_news.php' enctype=multipart/form-data>
                    <label>Hình ảnh</label>
                    <input type="file" name="avatar" required><br>

                    <label for="title">Tiêu đề: </label>
                    <input name="title" type="text" required><br>

                    <label for="description">Mô tả ngắn: </label>
                    <input name="description" type="text" required><br>

                    <label for="content">Nội dung: </label>
                    <input name="content" type="text" required><br>

                    <p>Trạng thái</p>
                    <select name='status'>
                        <option value="0">Disable</option>
                        <option value="1">Action</option>
                    </select>
                    <p class='error' name='error'>
                    <?php
                    if(isset($_SESSION['error_add_news'])){
                        $error = $_SESSION['error_add_news'];
                        echo $error;
                        unset($_SESSION['error_add_news']);
                    }
                    ?>

                    </p>
                    <input name="submit" type="submit" value="Thêm">
                </form>
        </main>
    </div>
</body>
</html>
