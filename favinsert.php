<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//codeรับค่าการกด fav
//ต้องรับมา 2 ค่า ID_User ($_POST['iduserfav']) and ID_Content ($_POST['fav'])
//เก็บค่า ID_Content ไว้ในตัวแปร fav

if(isset($_POST['fav']) && $_POST['fav'] != '' ){ //รับตัวแปร fav และ fav ต้องไม่ใช่ค่าว่าง

    $iduserfav = $_POST['iduserfav'] ; //รับตัวแปรชื่อ  $_POST['iduserfav'] เข้ามาเก็บไว้ใน $iduserfav
    $idcontentfav = $_POST['fav'] ; //idcontent ที่จะ fav
    $statusfav = 'favorited';
    $Date_fav = date("Y-m-d") ;
    $Time_fav = date("H:i:s") ;

    //check Status_Fav = 'favorited'?
    $sql_checkfav = " SELECT ID_User,ID_Content,Status_Fav 
                        FROM favorite 
                        WHERE ID_User = '$iduserfav' && ID_Content = '$idcontentfav' && Status_Fav = 'favorited'" ;
        
        $result_checkfav = $link->query($sql_checkfav);
        $row_checkfav = $result_checkfav->fetch_assoc();
        $checkfav = $row_checkfav['Status_Fav'];

    //ดึงค่าtotalfav
    $sql_totalfav = "SELECT
                            ID_Content,
                            Total_Fav 
                        FROM
                            content 
                        WHERE
                            ID_Content = '$idcontentfav' ";

        $result_totalfav = $link->query($sql_totalfav);
        $row_totalfav = $result_totalfav->fetch_assoc();
        $totalfav = $row_totalfav['Total_Fav'];
        
       
        if($checkfav == 'favorited' ){
           
            //unfav
            $sql_unfav = " UPDATE favorite 
                            SET Status_Fav = 'unfavorite' 
                            WHERE ID_User = '$iduserfav' && ID_Content = '$idcontentfav'" ;
                $result_unfav = $link->query($sql_unfav);

            //ลบจำนวน totalfav in table content
            $sql_deltotalfav = " UPDATE content
                                 SET Total_Fav = '$totalfav'-1
                                 WHERE ID_Content = '$idcontentfav' ";
                $result_deltotalfav = $link->query($sql_deltotalfav);

                if($result_unfav && $result_deltotalfav){
                    echo "result_unfav is true \n"; }
                else{
                    echo "result_unfav is false ".mysqli_error($link)."\n" ;
                }

        }else{

            //fav
            $sql_fav = " INSERT INTO favorite ( ID_User, ID_Content, Status_Fav,Date_Fav,Time_Fav )
                        VALUES ('$iduserfav','$idcontentfav','$statusfav','$Date_fav','$Time_fav')" ; //เก็บค่าการกดfav

                $result_fav = $link->query($sql_fav);

            //เพิ่มจำนวน totalfav in table content
            $sql_plustotalfav = " UPDATE content
                                  SET Total_Fav = '$totalfav'+1
                                  WHERE ID_Content = '$idcontentfav' ";

                $result_plustotalfav = $link->query($sql_plustotalfav);

            if($result_fav && $result_plustotalfav){
                echo "result_fav is true \n"; }
            else{
                echo "result_fav is false ".mysqli_error($link)."\n" ;
            }

        }

}

mysqli_close($link);

?>