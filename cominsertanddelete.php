<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code insert comment
//ต้องรับมา 3 ค่า ID_User ($_POST['idusercom']), ID_Content ($_POST['com']) and textcom = $_POST['textcom']

//กดช่องcommentรับค่า ID_Content ที่ต้องการมา
if(isset($_POST['com']) && $_POST['com'] != '' ){

    $idusercom = $_POST['idusercom'] ; //รับตัวแปรชื่อ  $_POST['idusercom'] เข้ามาเก็บไว้ใน $idusercom
    $idcontentcom = $_POST['com'] ;
    $textcom = $_POST['textcom'] ;
    $statuscom = '1';

    $sql_com = " INSERT INTO `comment` (ID_User,ID_Content,Text_Comment,Status_Comment)
                                VALUES ('$idusercom','$idcontentcom','$textcom','$statuscom')" ;
        
        $result_com = $link->query($sql_com);
        if($result_com){
            echo "result_com is true \n"; }
        else{
            echo "result_com is false ".mysqli_error($link)."\n" ;
            }

        }else{
            
            //comdelete
            //รับค่า ID_Comment จากตัวแปร $_POST['comdelete'] อาจจะเป็นรูปถังขยะ
            if(isset($_POST['comdelete']) && $_POST['comdelete'] != '' ){

                $idcomment = $_POST['comdelete'] ;
                $statuscomdelete = '0';
            
                $sql_comdelete = " UPDATE `comment` 
                                    SET Status_Comment = '0' 
                                    WHERE ID_Comment = '$idcomment'" ;
                    
                    $result_comdelete = $link->query($sql_comdelete);
                    if($result_comdelete){
                        echo "result_comdelete is true \n"; }
                    else{
                        echo "result_comdelete is false ".mysqli_error($link)."\n" ;
                        }
           
            }
        }

mysqli_close($link);

?>