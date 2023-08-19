<?php
// Gọi session_start() để bắt đầu phiên làm việc
session_start();
$msg_mail = "";
// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION["user_id"])) {
    // Nếu không có phiên làm việc, chuyển hướng người dùng đến trang đăng nhập
    header("Location: ../accounts/login.php");
    exit();
}

// Kiểm tra xem người dùng có vai trò là người dùng thường hay không
if ($_SESSION["role"] !== 'user') {
    // Nếu không phải người dùng thường, chuyển hướng về trang chính
    header("Location: ../experts/expert_page.php");
    exit();
}

// Kiểm tra xem có dữ liệu được gửi từ form soạn thư hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["recipient_name"]) && isset($_POST["title"]) && isset($_POST["content"])) {
        $recipient_id = $_POST["recipient_name"];
        $title = $_POST["title"];
        $content = $_POST["content"];

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

        // Thêm thông tin thư vào bảng "letters"
        $sql_insert_email = "INSERT INTO letters (sender_id, receiver_id, title, content) VALUES (?, ?, ?, ?)";
        $stmt_insert_email = $conn->prepare($sql_insert_email);
        $stmt_insert_email->bind_param("iiss", $_SESSION["user_id"], $recipient_id, $title, $content);

        if ($stmt_insert_email->execute()) {
            $msg = "Thư đã được gửi thành công";
            $_SESSION['msg'] = $msg;
            header("Location: ../users/home.php");
        } else {
            $msg = "Đã xảy ra lỗi. Vui lòng thử lại!";
            $_SESSION['msg'] = $msg;
            header("Location: write_letter.php ");
        }

        // Đóng câu lệnh Prepared Statement
        $stmt_insert_email->close();

        // Đóng kết nối
        $conn->close();
    } else {
        header("Location: ../redirect/loithu.html ");
    }
} else {
    header("Location: ../redirect/loithu.html ");
}
?>