<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Trang cá nhân</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Poppins:wght@400;700&family=Quicksand:wght@400;700&family=Raleway:wght@300;900&display=swap" rel="stylesheet">
        <script>
            function question(){
                if(confirm('Bạn có chắc muốn đăng xuất?'))
                {
                    window.location.href = "logout.php";
                }
            }
        </script>
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
                        <li><a class="menu-content" id="quanly" href="../quanly/quanly.php">Quản lý</a>
                            <ul>
                                <li><a href="../quanly/quanly_users.php">Người dùng</a></li>
                                <li><a href="../quanly/quanly_expert.php">Chuyên gia</a></li>
                            </ul>
                       </li>
                        <li><a class="menu-content" id="pro" href="profile.php">Pro5</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <br><br>
        <main id="main-prf">
            
            <?php
                session_start();
                $servername = "localhost";
                $username = "emo";
                $password = "123456EmoR2";
                $dbname = "emo";
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Truy vấn thông tin gười dùng
                $ma_id = $_SESSION["ma_id"];
                $sql_user = "SELECT * FROM managers WHERE id='$ma_id';";
                $result_user = $conn->query($sql_user);
                if($result_user->num_rows>0)
                {
                    // Lặp qua từng dòng dữ liệu
                    while($row=$result_user->fetch_assoc())
                    {
                        //Lấy dữ liệu từ cột trong dòng hiện tại
                        $ma_id = $row['id'];
                        $username=$row['username'];
                        $email = $row['email'];

                    }
                    echo "<div id='ten-prf'><h3 id='div-content-prf'>Tên người dùng: </h3><p id='ten-txt'>", $username, "</p></div>";
                    echo "<hr>";
                    echo "<br>";
                    echo "<p class='info-prf'>Email: ", $email, "</p><br>";
                    echo "<br>";
                }else{
                    echo "Không có dữ liệu";
                }  

                $conn->close();
            ?>
            <button class="info-prf" id="logout" onclick="question()">Đăng Xuất</button>
        </main>
    </body>
</html>