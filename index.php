<?php

session_start();



$user_db = '';
$pass_db = '';
$ok = false;


// if(isset($_SESSION['mobile']) && strlen($_SESSION['mobile'])==11){

//     echo '
//     <meta http-equiv="refresh" content="0; url=assets\page\home.php">
//     ';
//     die();

// }else{

//     $_SESSION['namefull']='';
//     $_SESSION['mobile']='';
    
// }


if(isset($_COOKIE['mobile']) && strlen($_COOKIE['mobile'])==11){

    echo '
    <meta http-equiv="refresh" content="0; url=assets\page\home.php">
    ';
    die();

}else{

    $_COOKIE['namefull']='';
    $_COOKIE['mobile']='';
    
}



if (isset($_POST['input_name'])) {
    
    $file=fopen('db.txt','r');

    $user = $_POST['input_name'];
    $pass = $_POST['input_password'];
    // echo $user.'<br>'.$pass.'<br>';


    for ($i=0; $i <4 ; $i++) { 
        $read=fgets($file);
        
        $data= explode(",",$read);

        $user_db =$data[0];
        $pass_db =$data[1];
        echo $user_db.'<br>'.$pass_db.'<br>';

        if ($user == $user_db && $pass == $pass_db) {
            # code...
            $ok = true;
            echo 'true';
    
            // $_SESSION['namefull']=$data[3];
            // $_SESSION['mobile']=$data[2];
            setcookie( 'namefull' , $data[3] , time() + (36400 *30),"/" );
            setcookie( 'mobile' , $data[2] , time() + (36400 *30),"/" );
    
    
        }else{
            echo 'false' ;
        }

    }
    

    




    // echo 'user: ' .$user;
    // echo '<br>';
    // echo 'passworld: ' .$pass;

}




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets\style\style.css" rel="stylesheet">
</head>

<body dir="rtl">

    <div class="login-form-style">
        <h1>ورود</h1>
        <!-- <form action="index.php" method='post'> -->
            <p> نام کاربری:</p>
            <input type="tel" name="input_name" id="input_name" class="input-style">
            <br>
            <p>رمز عبور:</p>
            <input type="password" name="input_password" id="input_password" class="input-style">
            <br>
            <button onclick="send()" class="button-style" id="send_btn" style="background-color: rgb(41, 112, 41); color: white;">ورود</button>
            <button type="button" class="button-style">
                <a href="reg.php" style="color: black; text-decoration: none; font-family: Verdana, Geneva, Tahoma, sans-serif;">ثبتنام</a>
            </button>

        <pre id="error1">نام کاربری یا رمز عبور شما اشتباه است</pre>
        <pre id="ok1">شما با موفقیت وارد شدید.</pre>

        <!-- </form> -->
        <!-- <?php
            // if ($ok) {
                
            //     echo '
            //             <pre>شما با موفقیت وارد شدید</pre>

            //             <meta http-equiv="refresh" content="2; url=assets\page\home.php">
            //         ';

            // }elseif ($ok = false) {
            //     echo'<pre>نام کاربری یا رمز عبور صحیح نیست/pre>';
            // }
        ?> -->
         
    </div>
    <script>
        function send() {
            document.getElementById('error1').style.display='none';
            document.getElementById('send_btn').disabled=true;
            user=document.getElementById('input_name').value;
            passworld=document.getElementById('input_password').value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); 
                let ok= this.responseText;

                document.getElementById('send_btn').disabled=false;


                if (ok=='1') {
                    document.getElementById('error1').style.display='none';
                    document.getElementById('ok1').style.display='block';

                    window.location.assign('assets/page/home.php')
                }
                if (ok=='0') {
                    document.getElementById('error1').style.display='block';
                    document.getElementById('ok1').style.display='none';

                }
            }
            };
            xmlhttp.open("GET", "ajax.php?user=" + user + "&pass=" + passworld, true);
            xmlhttp.send();
        
        }
        
</script>
</body>

</html>