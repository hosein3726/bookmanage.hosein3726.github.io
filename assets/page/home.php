<?php

session_start();
$db = mysqli_connect('localhost','root','','amir');

if (isset($_POST['bookName'])) {
    $book_name=$_POST['bookName'];
    $book_pages=$_POST['pages'];
    $book_year=$_POST['year'];

    if (true) {
        mysqli_query($db,"insert into books(book_name, book_page, book_year) values ('$book_name','$book_pages','$book_year')");

    }
}
if (isset($_GET['del'])) {
    $book_id_del=$_GET['del'];
    $sql=mysqli_query($db,"update `books` set `del`='1' where `id`='$book_id_del'");
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
        <li><a href="..\page\upload_page.php" class="link_button">آپلود فایل</a></li>
        <li style="float: right;" ><?php echo $_COOKIE['namefull']?> <p style="font-family: Titr;">خوش آمدید</p></li>

    </ul>

    <br>
    <main>


        <div class="container">
            <h2>لیست کاربران 👦</h2>

            <table>
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام کاربری</th>
                        <th>نام و نام خانوادگی</th>
                        <th>شماره تلفن</th>
                        <!-- <th>عملیات</th> -->
                    </tr>
                </thead>
            
                <tbody id="bookTable">

                <?php
                $i=0;
                $sql=mysqli_query($db,"select * from `user`");
                while ($row=mysqli_fetch_assoc($sql)) {
                    $user_name=$row['username'];
                    $name_full=$row['namefull'];
                    $mobile=$row['mobile'];
                    $i=$i+1;
                    echo"                    
                    <tr>
                    <td>$i</td>
                    <td>$user_name</td>
                    <td>$name_full</td>
                    <td>$mobile</td>
                    </tr>";
                }

                ?>
                </tbody>
            
            </table>
        </div>
        <br>
        <div class="container">
        
            <h2>لیست کتاب‌ها 📚</h2>
            <form action="home.php" method="post">

                <input type="text" id="bookName" name="bookName" placeholder="نام کتاب">
                <input type="number" id="pages" name="pages" placeholder="تعداد صفحات">
                <input type="number" id="year" name="year" placeholder="سال انتشار">
                
                <button type="submit">افزودن</button>

            </form>

            
            <table>
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام کتاب</th>
                        <th>تعداد صفحات</th>
                        <th>سال انتشار</th>
                        <th>عملیات</th>
                    </tr>

                </thead>
            
                <tbody id="bookTable">

                <?php
                $i=0;
                $sql=mysqli_query($db,"select * from `books` where del='0'");
                while ($row=mysqli_fetch_assoc($sql)) {
                    $book_name=$row['book_name'];
                    $book_page=$row['book_page'];
                    $book_year=$row['book_year'];
                    $book_id=$row['id'];
                    $i=$i+1;
                    echo"                    
                    <tr>
                    <td>$i</td>
                    <td>$book_name</td>
                    <td>$book_page</td>
                    <td>$book_year</td>
                    <td>
                    <a href='home.php?del=$book_id'>
                    <button class='deleteBtn' >حذف</button>
                    </a>
                    </td>
                    </tr>";
                }

                ?>
                </tbody>
            
            </table>
        
        </div>
    </main>

<script>

function addBook(){

    let name=document.getElementById("bookName").value.trim();
    let pages=document.getElementById("pages").value;
    let year=document.getElementById("year").value;

    if(name=="" || pages=="" || year==""){
        alert("تمام فیلدها را وارد کنید.");
        return;
    }

    let table=document.getElementById("bookTable");

    let row=table.insertRow();

    row.insertCell(0);
    row.insertCell(1).innerHTML=name;
    row.insertCell(2).innerHTML=pages;
    row.insertCell(3).innerHTML=year;
    row.insertCell(4).innerHTML=
        '<button class="deleteBtn" onclick="removeBook(this)">حذف</button>';

    updateRows();

    document.getElementById("bookName").value="";
    document.getElementById("pages").value="";
    document.getElementById("year").value="";
}

function removeBook(btn){
    btn.parentElement.parentElement.remove();
    updateRows();
}

function updateRows(){

    let rows=document.querySelectorAll("#bookTable tr");

    rows.forEach(function(row,index){
        row.cells[0].innerHTML=index+1;
    });

}

</script>

</body>
</html>