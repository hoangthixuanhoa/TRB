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
    <title>Trang chủ</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script>
        function send_mail(){
            window.location.href = "compose.php";
        }
        function write_journal(){
            window.location.href = "../journals/choice_emo.php";
        }
    </script>
    <style>
        #home{
            text-shadow: 2px 2px 5px palevioletred;
        }
        
    </style>
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
                    <li><a class="menu-content" id="prf" href="../accounts/profile.php"><img id="img-user" src="../img/user.png"></a></li>
                </ul>
            </div>
            <div id="thumb">
                <div id="thumb-person">
                    <div>
                        <img src="../img/Happy Person.png" id="bg_cr">
                    </div>
                    <div id="thumb-content">
                        <h3 id="div-content-thumb">CẢM XÚC CỦA BẠN LÀ ĐIỀU TRÂN QUÝ NHẤT</h3>
                        <div><p id='text-thumb'>Mỗi người trong chúng ta đều ẩn chứa những tâm sự và những cảm xúc mãnh liệt nhưng lại khó nói.<img id="emo-home" src="../img/logo.png">sẽ là nơi ươm mầm cho khu vườn cảm xúc của bạn, là nơi bạn có thể thoải mái sống đúng với cảm xúc của bản thân và viết ra hết những dòng suy nghĩ đang nặng trĩu trong lòng. </p></div>
                    </div>
                </div>
                <div>
                    <img src="../img/Rainbow.png" id="rainbow">
                </div>
            </div>
        </div>
        <div id='pattern'></div>
    </header>
    <main id="home-container">
        <div id="qs-home">
            <h3 class="h3-viet" id="ask-home">Hãy viết và để <img id="emo-home1" src="../img/logo.png">nâng niu mọi cảm xúc của bạn</h3>
        </div>
        <div id="choice-home">
            <div class="viet-home">
                <div class="btn-container-home">
                    <div class="btn-content"><button class="btn-home" onclick="send_mail()">Viết thư</button></div>
                    <p class="text-home">Bạn đang gặp vấn đề và cần lời khuyên từ một chuyên gia tâm lý</p>
                </div>
            </div>
            <div class="viet-home">
                <div class="btn-container-home">
                    <div class="btn-content"><button class="btn-home" onclick="write_journal()">Viết tâm sự</button></div>
                    <p class="text-home">Bạn có nhiều cảm xúc trong lòng và muốn bày tỏ để nhẹ lòng hơn</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
