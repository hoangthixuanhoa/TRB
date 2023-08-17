<?php
// Gọi session_start() để bắt đầu phiên làm việc
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION["user_id"])) {
    // Nếu không có phiên làm việc, chuyển hướng người dùng đến trang đăng nhập
    header("Location: accounts/login.php");
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
    <title>Viết</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <header>
        <div id="head-content">
            <div id="menu">
                <ul id="menu-ul">
                    <li><a class="menu-content" id="home" href="../users/">Trang chủ</a></li>
                    <li><a class="menu-content" id="write" href="../users/viet.php">Viết</a></li>
                    <li><img id="logo" src="../img/logo.png"></li>
                    <li><a class="menu-content" id="garden" href="../journals/view_journal.php">Vườn</a></li>
                    <li><a class="menu-content" id="prf" href="../users/view_reply.php"><img id="img-user" src="../img/letter.png"></a></li>
                    <li><a class="menu-content" id="prf" href="../accounts/profile.php"><img id="img-user" src="../img//user.png"></a></li>
                </ul>
            </div>
        </div>
    </header>
    <main id="main-read">
        <div><h3 id='div-content-read'>Đọc nhật kí</h3></div>
        <div id="read-container">
            <?php
                $id=$_GET['id'];
                $servername = "localhost";
                $username = "emo";
                $password = "123456EmoR2";
                $dbname = "emo";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                //$camxuc = $_SESSION['camxuc'];
                $sql = "SELECT * FROM journals WHERE id='$id';";
                $result = $conn->query($sql);
                if($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc())
                        {
                            //Lấy dữ liệu từ cột trong dòng hiện tại
                            $id = $row['id'];
                            $camxuc = $row['emotion'];
                            $content = $row['content'];
                            $date = $row['date'];
                            $month = $row['month'];
                            $year = $row['year'];
                        }
                    echo "<div class='info-read'><p class='info-read-p'>Ngày viết: ",$date,"/",$month,"/",$year,"</p></div>";
                    echo "<form method='post' action='update_change.php?id=$id' >";
                    if($camxuc=='1'){
                        echo "<div class='info-read' id='camxuc-read'><p class='info-read-p'>Cảm xúc: </p><p class='info-read-p' id='vui-prf'><input type='radio' name='camxuc' value='1' checked>Vui</p>";
                        echo "<p class='info-read-p' id='buon-prf''><input type='radio' name='camxuc' value='2' >Buồn</p>";
                        echo "<p class='info-read-p' id='khac-prf'><input type='radio' name='camxuc' value='3' >Khác</p></div>";
                    }
                    elseif($camxuc=='2'){
                        echo "<div class='info-read' id='camxuc-read'><p class='info-read-p'>Cảm xúc: </p><p class='info-read-p' id='vui-prf'><input type='radio' name='camxuc' value='1'>Vui</p>";
                        echo "<p class='info-read-p' id='buon-prf''><input type='radio' name='camxuc' value='2' checked>Buồn</p>";
                        echo "<p class='info-read-p' id='khac-prf'><input type='radio' name='camxuc' value='3' >Khác</p></div>";
                    }
                    else{
                        echo "<div class='info-read' id='camxuc-read'><p class='info-read-p'>Cảm xúc: </p><p class='info-read-p' id='vui-prf'><input type='radio' name='camxuc' value='1'>Vui</p>";
                        echo "<p class='info-read-p' id='buon-prf''><input type='radio' name='camxuc' value='2' >Buồn</p>";
                        echo "<p class='info-read-p' id='khac-prf'><input type='radio' name='camxuc' value='3' checked>Khác</p></div>";
                    }
                    echo "<div class='info-read'><p class='info-read-p'>Nội dung: <input name='content' type='text' value='",$content, "'</p></div>";
                    echo "<a class='btn-ch' id='a-ch' href='read_journal.php?id=$id'>Hủy</a>";
                    echo "<input class='btn-ch' type='submit' value='Lưu'>";
                    echo "</form>";
                }else{
                    echo "Không có dữ liệu";
                }

                $conn->close();
            ?>
        </div>
    </main>
</body>
</html>