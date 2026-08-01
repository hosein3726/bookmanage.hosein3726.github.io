<?php

$db = mysqli_connect('localhost','root','','amir');
$sql= mysqli_query($db, " select * from `user` WHERE username='mohamad' ");
$row= mysqli_fetch_assoc($sql);
print_r($row);
?>