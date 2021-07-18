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
    $statementrp = $_POST['statement'] ;
    $statusreport = '1';
    $Date_Report = date("Y-m-d") ;
    $Time_Report = date("H:i:s") ;

    //select username
    $sql_selectusername = " SELECT Username FROM `user` WHERE ID_User = '$iduser'" ;
        $result_selectusername = $link->query($sql_selectusername);

    //select title
    $sql_selecttitle = "SELECT Title FROM content WHERE ID_Content = '$idcontentreport'";
        $result_selecttitle = $link->query($sql_selecttitle);

    if($result_selectusername && $result_selecttitle){

        $row_selectusername = $result_selectusername->fetch_assoc();
        $selectusername = $row_selectusername['Username'];
        // echo $selectusername;
        
        $row_selecttitle = $result_selecttitle->fetch_assoc();
        $selecttitle = $row_selecttitle['Title'];
        // echo $selecttitle;

        //insert to report
        $sql_report = " INSERT INTO report( ID_User,Username, ID_Content,Title,Statement, Status_Report,Date_Report,Time_Report ) 
                        VALUES ('$iduser','$selectusername','$idcontentreport','$selecttitle','$statementrp','$statusreport','$Date_Report','$Time_Report')" ;
        
        $result_report = $link->query($sql_report);

            if($result_report){
                echo "result_report is true \n"; }
            else{
                echo "result_report is false ".mysqli_error($link)."\n" ;
            }
    }


    // $sql_report = " INSERT INTO report( ID_User, ID_Content, Status_Report,Date_Report,Time_Report ) 
    //                 VALUES ('$iduser','$idcontentreport','$statusreport','$Date_Report','$Time_Report')" ;
        
    //     $result_report = $link->query($sql_report);

    //         if($result_report){
    //             echo "result_report is true \n"; }
    //         else{
    //             echo "result_report is false ".mysqli_error($link)."\n" ;
    //         }

        }

mysqli_close($link);

?>