<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/guithu.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <title>Viết thư</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Quicksand:wght@400;700&family=Raleway:wght@300;900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div id="head-content">
            <div id="menu">
                <ul id="menu-ul">
                    <li><a class="menu-content" id="home" href="home.php">Trang chủ</a></li>
                    <li><a class="menu-content" id="write" href="viet.php">Viết</a></li>
                    <li><img id="logo" src="../img/logo.png" height= "60px"></li>
                    <li><a class="menu-content" id="garden" href="../journals/view_journal.php">Vườn</a></li>
                    <li><a class="menu-content" id="prf" href="view_reply.php"><img id="img-user" src="../img/letter.png"></a></li>
                    <li><a class="menu-content" id="prf" href="../accounts/profile.php"><img id="img-user" src="../img//user.png"></a></li>
                </ul>
            </div>
    </header>

    <div class="thongbao">
        <h3>Bạn đang gặp phải vấn đề gì?</h3>
    </div>

    <form action="send_email.php" method="post">
        <div class="recipient-wrapper">
            <label for="recipient">Người nhận:</label>
            <select id="recipient" name="recipient" required>
                <option value="" selected disabled>Chọn ngưởi nhận</option>
                    <?php
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

                    // Truy vấn để lấy danh sách người nhận
                    $sql_get_experts = "SELECT id, username FROM users WHERE role = 'user'";
                    $result_get_experts = $conn->query($sql_get_experts);

                    // Hiển thị danh sách các người nhận làm tùy chọn trong dropdown
                    if ($result_get_experts->num_rows > 0) {
                        while ($row = $result_get_experts->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["username"] . '</option>';
                        }
                    }
        
                    // Đóng kết nối
                    $conn->close();
                    ?>
            </select>
        </div>
        <br>

        <div class="tieude">
            <input type="text" name="title" id="title" placeholder="Tiêu đề: ">
        </div>

        <div class="tieude">
            <textarea name="content" id="content" placeholder="Nội dung lá thư..."></textarea>
        </div>
        <div class="cainut">
            <button type="submit">Gửi</button>
        </div>
    </form>
</body>
</html>