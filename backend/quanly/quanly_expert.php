<?php
// Gọi session_start() để bắt đầu phiên làm việc
session_start();


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
    <title>Quản Lý</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <div id="head-content">
            <div id="logo">
                <img>
            </div>
            <div id="menu">
                <ul id="menu-ul">
                    <li><a class="menu-content" id="home" href="../manager/home.php">Trang chủ</a></li>
                    <li><a class="menu-content" id="quanly>Quản lý</a>
                        <ul>
                            <li><a href="quanly_users.php">Người dùng</a></li>
                            <li><a href="quanly_expert.php">Chuyên gia</a></li>
                        </ul>
                    </li>
                    <li><a class="menu-content" id="pro" href="../accounts/profile.php">Pro5</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main id="home-container">
        <table>
            <tr>
                <th class="title">ID</th>
                <th class="title">Tên đăng nhập</th>
                <th class="title">Email</th>
            </tr>
            <?php
                $sql_emo = "SELECT * FROM users WHERE role='expert';";
                $result_emo = $conn->query($sql_emo);
                $count = 0;
                if($result_emo->num_rows>0)
                {
                    while($row=$result_emo->fetch_assoc()){
                        $count++;
                        //Lấy dữ liệu từ cột trong dòng hiện tại
                        $id = $row['id'];
                        $username = $row['username'];
                        $email = $row['email'];
                        echo "<tr>";
                        echo "<td>",$id,"</td>";
                        echo "<td>",$username,"</td>";
                        echo "<td>",$email,"</td>";
                        echo "<td><a href='detail.php?id=$id'>Xem</a></td>";
                        echo "</tr>";
                    }
                }
            
            ?>
        </table>
        <?php
        echo "<h3>Có tất cả: ", $count, " người dùng</h3>";
        ?>
    </main>
</body>
</html>
