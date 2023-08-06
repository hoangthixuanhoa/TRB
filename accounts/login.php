<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/login_register.css">
    <script>
        function validate(){
            var username = document.getElementById('username').value;
            var psw =document.getElementById('password').value;

            sessionStorage.username=username;
            sessionStorage.psw=psw;
        }
        function init(){
            var regForm =document.getElementById('registerForm');
            regForm.onsubmit = validate;
        }
        window.onload = init;
        
    </script>
</head>
<body>
    <div id='pattern'></div>
    <main>
        <div id="wlc">
            <div ><img id="img-wlc" src="../img/Design.png"></div>
            <div id="wlc-content">
                <div id="wlc-login">
                    <h1 id="wlc-txt">Chào mừng bạn đến với</h1>
                    <img id="emo" src="../img/logo.png">
                </div>
                <form action="check_login.php" method="post">
                    <label for="username">Tên đăng nhập</label><br>
                    <input class="input-in" type="text" id="username" name="username" placeholder="Tên đăng nhập" required>
                    <br>
                    <label for="password">Mật khẩu</label><br>
                    <input class="input-in" type="password" id="password" name="password" placeholder="Mật khẩu" required>
                    <br>
                    <div id="error-container">
                        <?php
                            session_start();
                            $error = "";
                            if(isset($_SESSION['error_login'])){
                                $error = $_SESSION['error_login'];
                                echo "<p id='error'>",$error,"</p>";
                                unset($_SESSION['error_login']);
                            }
                            else{
                                echo "";
                            }
                        ?>
                    </div>
                    <div id="div-sub"><input type="submit" value="Đăng nhập" id="sub"></div>
                </form>
                <!-- Nút Đăng ký -->
                <div id="qs">
                    <p id="txt-qs">Bạn chưa có tài khoản? <a href="register.php" id="a-in">Đăng ký ngay</a></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
