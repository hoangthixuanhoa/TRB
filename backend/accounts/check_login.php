<?php
session_start();
// Kết nối đến cơ sở dữ liệu (chú ý thay đổi thông tin kết nối phù hợp với máy bạn)
$servername = "localhost";
$username = "emo";
$password = "123456EmoR2";
$dbname = "emo";

$conn = new mysqli($servername, $username, $password, $dbname);
$error = "";
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý thông tin đăng nhập khi người dùng nhấn nút "Đăng nhập"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_input = $_POST["username"]; // Nhận giá trị từ trường "Tên đăng nhập" hoặc "Email"
    $password = $_POST["password"];
    $_SESSION['username_log']=$login_input;
    $_SESSION['pwd_log']= $password;

    // Kiểm tra xem người dùng đã nhập email hay tên đăng nhập
    if (filter_var($login_input, FILTER_VALIDATE_EMAIL)) {
        $login_type = 'email';
    } else {
        $login_type = 'username';
    }

    // Truy vấn để kiểm tra thông tin đăng nhập
    $sql_check_login = "SELECT id, username, password FROM managers WHERE $login_type = ?";
    $stmt_check_login = $conn->prepare($sql_check_login);
    $stmt_check_login->bind_param("s", $login_input);
    $stmt_check_login->execute();
    $stmt_check_login->store_result();

    if ($stmt_check_login->num_rows == 1) {
        // Lấy thông tin từ cơ sở dữ liệu
        $stmt_check_login->bind_result($user_id, $username, $hashed_password);
        $stmt_check_login->fetch();

        // Kiểm tra mật khẩu
        if (password_verify($password, $hashed_password)) {

            // Lưu thông tin đăng nhập vào phiên làm việc
            $_SESSION["ma_id"] = $user_id;
            $_SESSION["username"] = $username;
            header("Location: ../manager/home.php");

        } else {
            $error = "Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại!\n";
            $_SESSION['error_login_ma']=$error;
            header("Location: login.php");
        }
    } else {
        $error = "Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại!\n";
        $_SESSION['error_login_ma']=$error;
        header("Location: login.php");
    }

    // Đóng câu lệnh Prepared Statement
    $stmt_check_login->close();
}

// Đóng kết nối
$conn->close();

?>

