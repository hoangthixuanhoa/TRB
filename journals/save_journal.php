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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $camxuc = $_SESSION['camxuc'];
    $date = getdate();
    $day = $date['mday'];
    $month = $date['mon'];
    $year = $date['year'];
    $_SESSION['camxuc'] = $camxuc;
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content_tamsu'];
    
    $sql_check_day = "SELECT date FROM journals WHERE date=?";
    $stmt_check_day = $conn->prepare($sql_check_day);
    $stmt_check_day->bind_param("s", $day);
    $stmt_check_day->execute();
    $result_check_day = $stmt_check_day->get_result();

    $sql_check_month = "SELECT month FROM journals WHERE month=?";
    $stmt_check_month = $conn->prepare($sql_check_month);
    $stmt_check_month->bind_param("s", $month);
    $stmt_check_month->execute();
    $result_check_month = $stmt_check_month->get_result();

    $sql_check_year = "SELECT year FROM journals WHERE year=?";
    $stmt_check_year = $conn->prepare($sql_check_year);
    $stmt_check_year->bind_param("s", $year);
    $stmt_check_year->execute();
    $result_check_year = $stmt_check_year->get_result();

    $error_jour="";
    // Lưu thư vào cơ sở dữ liệu
    if(($result_check_day->num_rows > 0)and($result_check_month->num_rows > 0)and($result_check_year->num_rows > 0))
    {
        $error_jour="Một ngày chỉ viết 1 nhật kí!";
        $_SESSION['error_jour']=$error_jour;
        header("Location: view_journal.php");
        exit();
    }
    else{
        $sql_insert_journal = "INSERT INTO journals (user_id, emotion, content, date, month, year) VALUES ('$user_id', '$camxuc', '$content', '$day', '$month', '$year')";
        mysqli_query($conn,$sql_insert_journal);
        header("Location: view_journal.php");
        exit();
    }
    
}
$conn->close();
?>
