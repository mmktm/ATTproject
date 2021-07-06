<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//codeรับค่าการกด save
//ต้องรับมา 2 ค่า 
//ID_User ($_POST['idusersave']) and ID_Content ($_POST['save'])
//เก็บค่า ID_Content ไว้ในตัวแปร save

//รับค่า idcontent
if(isset($_POST['save']) && $_POST['save'] != '' ){ //รับตัวแปร save และ save ต้องไม่ใช่ค่าว่าง

    $idusersave = $_POST['idusersave'] ; //รับตัวแปรชื่อ  $_POST['idusersave'] เข้ามาเก็บไว้ใน $idusersave
    $idcontentsave = $_POST['save'] ;
    $statussave = '1';
    $Date_save = date("Y-m-d") ;
    $Time_save = date("H:i:s") ;

    $sql_checksave = " SELECT ID_User,ID_Content,Status_Save 
                        FROM save
                        WHERE ID_User = '$idusersave' && ID_Content = '$idcontentsave' && Status_Save = '1'" ;
        
        $result_checksave = $link->query($sql_checksave);
        $row_checksave = $result_checksave->fetch_assoc();
        $checksave = $row_checksave['Status_Save'];
       
        if($checksave == '1' ){
           
            //unsave
            $sql_unsave = " UPDATE saveorite 
                            SET Status_save = '0' 
                            WHERE ID_User = '$idusersave' && ID_Content = '$idcontentsave'" ;
                $result_unsave = $link->query($sql_unsave);
                if($result_unsave){
                    echo "result_unsave is true \n"; }
                else{
                    echo "result_unsave is false ".mysqli_error($link)."\n" ;
                }

        }else{

            //save
            $sql_save = " INSERT INTO save ( ID_User, ID_Content, Status_Save,Date_Save,Time_Save )
                        VALUES ('$idusersave','$idcontentsave','$statussave','$Date_save','$Time_save')" ; //เก็บค่าการกดfav

                $result_save = $link->query($sql_save);

            if($result_save){
                echo "result_save is true \n"; }
            else{
                echo "result_save is false ".mysqli_error($link)."\n" ;
            }

        }
}

mysqli_close($link);

?>