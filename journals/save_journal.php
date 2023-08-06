<?php
// Kiểm tra xem người dùng đã đăng nhập hay chưa
session_start();
if (!isset($_SESSION["user_id"])) {
    // Nếu không có phiên làm việc, chuyển hướng người dùng đến trang đăng nhập
    header("Location: ../accounts/login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Kết nối đến cơ sở dữ liệu (chú ý thay đổi thông tin kết nối phù hợp với máy bạn)
    $servername = "localhost";
    $username = "emo";
    $password = "123456EmoR2";
    $dbname = "emo";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $camxuc = $_SESSION['camxuc'];
    $date = getdate();
    $day = $date['mday'];
    $month = $date['mon'];
    $year = $date['year'];
    if ($camxuc=="vui"){
        $camxuc=1;
    }
    elseif($camxuc=="buon"){
        $camxuc=2;
    }else{
        $camxuc=3;
    }
    $_SESSION['camxuc'] = $camxuc;
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content_tamsu'];
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    // Lưu thư vào cơ sở dữ liệu
    $sql_insert_journal = "INSERT INTO journals (user_id, emotion, content, date, month, year) VALUES ('$user_id', '$camxuc', '$content', '$day', '$month', '$year')";
    mysqli_query($conn,$sql_insert_journal);
    
    header("Location: view_journal.php");
    mysqli_close($conn);
    exit();
    
}
?>
