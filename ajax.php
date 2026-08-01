<?php
$db = mysqli_connect('localhost','root','','amir');


$ok=false;

if (isset($_GET['user'])) {

    $user = $_GET['user'];
    $pass = $_GET['pass'];
    
    $sql= mysqli_query($db, " select * from `user` WHERE username='$user' and passworld='$pass' ");


    if ($row= mysqli_fetch_assoc($sql)) {
        # code...
        $_SESSION['namefull']=$data[3];
        $_SESSION['mobile']=$data[2];
        setcookie( 'namefull' , $row['username'] , time() + (36400 *30),"/" );
        setcookie( 'mobile' , $row['mobile'] , time() + (36400 *30),"/" );
        $ok = true;
    }

}

if($ok){

    echo'1';
}else{
    echo'0';
}

?>