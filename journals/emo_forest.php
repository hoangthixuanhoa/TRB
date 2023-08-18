<?php
// Kiểm tra xem người dùng đã đăng nhập hay chưa
session_start();
if (!isset($_SESSION["user_id"])) {
    // Nếu không có phiên làm việc, chuyển hướng người dùng đến trang đăng nhập
    header("Location: ../accounts/login.php");
    exit();
}
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
$sql = "SELECT id FROM users";
$result_user = $conn->query($sql_user);
if($result_user->num_rows>0){
    while($row=$result_user->fetch_assoc()){
        
    }
}
$conn->close();

?>