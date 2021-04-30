<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code report
//ต้องรับมา 2 ค่า ID_User ($_POST['iduser']) and ID_Content ($_POST['report'])

if(isset($_POST['report']) && $_POST['report'] != '' ){

    $iduser = $_POST['iduser'] ; //รับตัวแปรชื่อ  $_POST['iduser'] เข้ามาเก็บไว้ใน $iduser
    $idcontentreport = $_POST['report'] ;
    $statusreport = '1';
    $Date_Report = date("Y-m-d") ;
    $Time_Report = date("H:i:s") ;

    $sql_report = " INSERT INTO report( ID_User, ID_Content, Status_Report,Date_Report,Time_Report ) 
                    VALUES ('$iduser','$idcontentreport','$statusreport','$Date_Report','$Time_Report')" ;
        
        $result_report = $link->query($sql_report);

            if($result_report){
                echo "result_report is true \n"; }
            else{
                echo "result_report is false ".mysqli_error($link)."\n" ;
            }

        }

mysqli_close($link);

?>