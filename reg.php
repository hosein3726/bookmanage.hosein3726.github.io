<?php
$db = mysqli_connect('localhost','root','','amir');

$error= '-';
$ok= false;

if (isset($_POST['input_name'])) {
    # code...

    $username = $_POST['input_name'];
    $pass = $_POST['input_password'];
    $namefull = $_POST['input_full_name'];
    $mobile = $_POST['input_mobile'];

    if (strlen($namefull)<5|| strlen($namefull)>90) {
        $error ='نام و نام خانوادگی را بصورت صحیح وارد کنید.';
    }
    if (strlen($mobile)<11|| strlen($mobile)>11) {
        $error ='شماره موبایل شما صحیح نمیباشد.';
    }
    if (substr($mobile,0,2) !='09') {
        $error ='شماره موبایل شما صحیح نمیباشد.';
    }
    


    if ($error=='-') {
        
        mysqli_query($db,"insert into user(username,passworld, namefull, mobile) values ('$username','$pass','$namefull','$mobile')");

        $ok=true;

    }


}




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://localhost:8080/login/assets/style/style.css" rel="stylesheet">
</head>

<body dir="rtl">

    <div class="login-form-style" style='height:450px;'>
        <h1>ثبت نام</h1>
        <form action="reg.php" method='post'>
            <p> نام کاربری :</p>
            <input type="text" name="input_name" id="input_name" class="input-style">
            <br>
            <p> نام و نام خانوادگی :</p>
            <input type="text" name="input_full_name" id="input_full_name" class="input-style">
            <br>
            <p> شماره موبایل :</p>
            <input type="tel" name="input_mobile" id="input_mobile" class="input-style" maxlength="11">
            <br>
            <p>رمز عبور:</p>
            <input type="password" name="input_password" id="input_password" class="input-style">
            <br>
            <button type="submit" class="button-style" style="background-color: rgb(41, 112, 41); color: white;">ثبت نام</button>
            <button type="button" class="button-style">
                <a href="index.php" style="color: black; text-decoration: none; font-family: Verdana, Geneva, Tahoma, sans-serif;">ورود</a>
            </button>
        
        </form>
        <?php
            if ($ok) {
                
                echo '
                        <pre>شما با موفقیت وارد شدید</pre>

                    ';

            }elseif ($error<>'-') {
                echo"
                <pre style=\"color: red  ;\">$error
                </pre>";
            }
        ?>
         
    </div>

</body>

</html>
