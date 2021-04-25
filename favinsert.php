<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//codeรับค่าการกด fav
//ต้องรับมา 2 ค่า ID_User ($_POST['iduserfav']) and ID_Content ($_POST['fav'])
//เก็บค่า ID_Content ไว้ในตัวแปร fav

if(isset($_POST['fav']) && $_POST['fav'] != '' ){

    $iduserfav = $_POST['iduserfav'] ; //รับตัวแปรชื่อ  $_POST['iduserfav'] เข้ามาเก็บไว้ใน $iduserfav
    $idcontentfav = $_POST['fav'] ;
    $statusfav = '1';

    $sql_checkfav = " SELECT ID_User,ID_Content,Status_Fav 
                        FROM favorite 
                        WHERE ID_User = '$iduserfav' && ID_Content = '$idcontentfav' && Status_Fav = '1'" ;
        
        $result_checkfav = $link->query($sql_checkfav);
        $row_checkfav = $result_checkfav->fetch_assoc();
        $checkfav = $row_checkfav['Status_Fav'];
       
        if($checkfav == '1' ){
           
            //unfav
            $sql_unfav = " UPDATE favorite 
                            SET Status_Fav = '0' 
                            WHERE ID_User = '$iduserfav' && ID_Content = '$idcontentfav'" ;
                $result_unfav = $link->query($sql_unfav);
                if($result_unfav){
                    echo "result_unfav is true \n"; }
                else{
                    echo "result_unfav is false ".mysqli_error($link)."\n" ;
                }

        }else{

            //fav
            $sql_fav = " INSERT INTO favorite ( ID_User, ID_Content, Status_Fav )
                        VALUES ('$iduserfav','$idcontentfav','$statusfav')" ; //เก็บค่าการกดfav

                $result_fav = $link->query($sql_fav);

            if($result_fav){
                echo "result_fav is true \n"; }
            else{
                echo "result_fav is false ".mysqli_error($link)."\n" ;
            }

        }
}

mysqli_close($link);

?>