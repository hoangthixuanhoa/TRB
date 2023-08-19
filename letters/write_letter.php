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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div id="head-content">
            <div id="menu">
                <ul id="menu-ul">
                    <li><a class="menu-content" id="home" href="../users/home.php">Trang chủ</a></li>
                    <li><a class="menu-content" id="write" href="../users/viet.php">Viết</a></li>
                    <li><img id="logo" src="../img/logo.png" height= "60px"></li>
                    <li><a class="menu-content" id="garden" href="../journals/view_journal.php">Vườn</a></li>
                    <li><a class="menu-content" id="prf" href="../users/view_reply.php"><img id="img-user" src="../img/letter.png"></a></li>
                    <li><a class="menu-content" id="prf" href="../accounts/profile.php"><img id="img-user" src="../img//user.png"></a></li>
                </ul>
            </div>    
        </div>
    </header>

    <div class="thongbao">
        <h3>Hãy tâm sự cùng bạn bè nhé</h3>
    </div>

    <form action="send_letter.php" method="post">
        <div class="recipient-wrapper">
            <label for="recipient_name">Người nhận:</label>
            <input type="text" name="recipient_name" id="recipient_name" placeholder="Tên người nhận" required>
        </div>
        <br>

        <div class="tieude">
            <input type="text" name="title" id="title" placeholder="Tiêu đề: ">
        </div>

        <script>
            $(document).ready(function(){
                $("#recipient_name").keyup(function(){
                    var recipient_name = $(this).val();
                    // Kiểm tra không để trống recipient_name
                    if(recipient_name != ''){
                        $.ajax({
                            url: 'verify_recipient.php',
                            method: 'GET',
                            data: {recipient_name: recipient_name},
                            success: function(data){
                                console.log(data);
                                if(data == "false"){
                                    $("#send_button").prop('disabled', true);
                                    alert("Tên người nhận không tồn tại");
                                } else {
                                    $("#send_button").prop('disabled', false);
                                }
                            }
                        });
                    } else {
                        $("#send_button").prop('disabled', true);
                    }
                });
            });
        </script>

        <div class="tieude">
            <textarea name="content" id="content" placeholder="Nội dung lá thư..."></textarea>
        </div>
        <div class="cainut">
            <button type="submit" id="send_button" disabled>Gửi</button>
        </div>
    </form>
</body>
</html>