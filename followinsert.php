<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//codeรับค่าการกด follow
//ต้องรับมา 2 ค่า ไอดีเรา ID_User ($_POST['iduser']) and ไอดีคนที่เรากำลังจะตาม ID_Following ($_POST['follow'])

if(isset($_POST['follow']) && $_POST['follow'] != '' ){

    $iduser = $_POST['iduser'] ; //รับตัวแปรชื่อ  $_POST['iduserfollow'] เข้ามาเก็บไว้ใน $iduserfollow
    $idfollowing = $_POST['follow'] ;
    $statusfollow = '1';
    $Date_Follow = date("Y-m-d") ;
    $Time_Follow = date("H:i:s") ;

    $sql_checkfollow = " SELECT ID_User,ID_Following,Status_follow 
                        FROM follow
                        WHERE ID_User = '$iduser' && ID_Following = '$idfollowing' && Status_follow = '1'" ;
        
        $result_checkfollow = $link->query($sql_checkfollow);
        $row_checkfollow = $result_checkfollow->fetch_assoc();
        $checkfollow = $row_checkfollow['Status_follow'];
       
        if($checkfollow == '1' ){
           
            //unfollow
            $sql_unfollow = " UPDATE follow
                                SET Status_follow = '0' 
                                WHERE ID_User = '$iduser' && ID_Following = '$idfollowing'" ;
                $result_unfollow = $link->query($sql_unfollow);
                if($result_unfollow){
                    echo "result_unfollow is true \n"; }
                else{
                    echo "result_unfollow is false ".mysqli_error($link)."\n" ;
                }

        }else{

            //follow
            $sql_follow = " INSERT INTO follow ( ID_User, ID_Following, Status_follow, Date_Follow,Time_Follow )
                        VALUES ('$iduser','$idfollowing','$statusfollow','$Date_Follow','$Time_Follow')" ; //เก็บค่าการกดfollow

                $result_follow = $link->query($sql_follow);

            if($result_follow){
                echo "result_follow is true \n"; }
            else{
                echo "result_follow is false ".mysqli_error($link)."\n" ;
            }

        }
}

mysqli_close($link);

?>