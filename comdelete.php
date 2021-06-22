<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

            //comdelete
            //รับค่า ID_Comment จากตัวแปร $_POST['comdelete'] อาจจะเป็นรูปถังขยะ
            if(isset($_POST['comdelete']) && $_POST['comdelete'] != '' ){ //รับค่าตัวแปร comdelete และ comdelete ต้องไม่ใช่ค่าว่าง

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

mysqli_close($link);

?>