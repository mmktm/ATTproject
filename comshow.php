<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code show data comment ของ content นั้นๆ
//ใช้คู่กับไฟล์แสดงข้อมูลของบทความ
//รับค่า ID_Content ($_POST['ID_Content'])

if(isset($_POST['ID_Content']) && $_POST['ID_Content'] != '' ){

    $idcontentcomshow = $_POST['ID_Content'] ;

    $sql_comshow = " SELECT 
                        `comment`.ID_Comment,
                        `user`.Username,
                        `comment`.Comment,
                        `comment`.Date_Comment,
                        `comment`.Time_Comment 
                        FROM 
                        `comment` JOIN `user` ON `comment`.ID_User = `user`.ID_User 
                        WHERE `comment`.ID_Content = '$idcontentcomshow' && `comment`.Status_Comment = '1' " ;
        
        $result_comshow = $link->query($sql_comshow);
        if($result_comshow->num_rows <=0 ){
            echo "No Comment" ;
        } else {
            while ($row_comshow = $result_comshow->fetch_assoc()){
                $output_comshow[] = $row_comshow ;
                $j_comshow = json_encode($output_comshow,JSON_NUMERIC_CHECK);
            }
            echo "$j_comshow\n" ;
        }
}

mysqli_close($link);

?>