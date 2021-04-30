<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code share
//ต้องรับมา 2 ค่า ID_User ($_POST['iduser']) and ID_Content ($_POST['share'])

if(isset($_POST['share']) && $_POST['share'] != '' ){

    $iduser = $_POST['iduser'] ; //รับตัวแปรชื่อ  $_POST['iduser'] เข้ามาเก็บไว้ใน $iduser
    $idcontentshare = $_POST['share'] ;
    $statusshare = '1';
    $Date_Share = date("Y-m-d") ;
    $Time_Share = date("H:i:s") ;

    $sql_share = " INSERT INTO share( ID_User, ID_Content, Status_Share,Date_Share ,Time_Share ) 
                    VALUES ('$iduser','$idcontentshare','$statusshare','$Date_Share','$Time_Share')" ;
        
        $result_share = $link->query($sql_share);

            if($result_share){
                echo "result_share is true \n"; }
            else{
                echo "result_share is false ".mysqli_error($link)."\n" ;
            }

        }

mysqli_close($link);

?>