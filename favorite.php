<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud


//ต้องรับมา 2 ค่า ID_User and ID_Content 
//เก็บค่า ID_Content ไว้ในตัวแปร fav

if(isset($_POST['fav']) && $_POST['fav'] != '' ){

    //รับตัวแปรชื่อ  $_POST['iduserfav'] เข้ามาเก็บไว้ใน $iduserfav
    $iduserfav = $_POST['iduserfav'] ;
    $idcontentfav = $_POST['fav'] ;

    $sql_fav = " INSERT INTO favorite ( ID_User, ID_Content, Status_Fav )
                        VALUES ('$iduserfav','$idcontentfav','1')" ;
}

mysqli_close($link);

?>