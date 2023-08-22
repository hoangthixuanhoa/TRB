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
                    <li><a class="menu-content" id="quanly" href="quanly.php">Quản lý</a>
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
        <?php
        $userID = $_GET['id'];
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
        $query = "SELECT * FROM news WHERE id='$userID'";
        $del = "";
        $result = $conn->query($query);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                //Lấy dữ liệu từ cột trong dòng hiện tại
                $title = $row['title'];
                $content = $row['content'];
                $description = $row['description'];
            }
            echo "Tiêu đề: ",$title,"<br>";
            echo "Mô tả: ",$description,"<br>";
            echo "Nội dung: ",$content,"<br>";
        }
        ?>
        <button>Sửa</button>
        <button>Xóa</button>
    </main>
</body>
</html>