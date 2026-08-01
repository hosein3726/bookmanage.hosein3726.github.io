<?php

session_start();

if (isset($_POST['submit'])) {
    # code...
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '..\uploads\imag.jpg')) {
        echo 'secsual';
    } else {
        # code...l
        echo'not upload';
    }
    
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://localhost:8080/login/assets/style/StyleHomePage.css">
<title>مدیریت کتاب‌ها</title>

<style>

</style>
</head>

<body>

    <ul>
        <li><a href="\login\logout.php" class="link_button">خروج</a></li>
        <li><a href="..\page\home.php" class="link_button">خانه</a></li>
        <li style="float: right;" ><?php echo $_COOKIE['namefull']?> <p style="font-family: Titr;">خوش آمدید</p></li>

    </ul>

    <br>
    <main>

        <div class="container">
            
            <h2>آپلود فایل</h2>
            <img src="..\uploads\imag.jpg" width="100%">
            <form action="upload_page.php" method="post" enctype="multipart/form-data">
                تصویر مورد نظر را آپلود فرمایید.
                <input type="file" id="fileToUpload" name="fileToUpload" >
                <input type="submit" id="Upload Image" name="submit">

            </form>

            

        
        </div>
    </main>


</body>
</html>