<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code showยอดshare ของcontent นั้นๆ
//รับค่า ID_Content ($_POST['ID_Content'])

if(isset($_POST['ID_Content']) && $_POST['ID_Content'] != '' ){ 

    $idcontentshare = $_POST['ID_Content'] ;

    $sql_shareshow = " SELECT COUNT(ID_User) AS share 
                        FROM share
                        WHERE ID_Content = '$idcontentshare' && Status_Share = 'shared' " ;
        
        $result_shareshow = $link->query($sql_shareshow);
            if($result_shareshow){
                $row_shareshow = $result_shareshow->fetch_assoc();
                // $output_shareshow[] = $row_shareshow ;
                // $j_shareshow = json_encode($output_shareshow,JSON_NUMERIC_CHECK);
                // echo "$j_shareshow\n" ; //[{}]

                $j_shareshow = json_encode($row_shareshow,JSON_NUMERIC_CHECK);
                echo "$j_shareshow\n" ;//ไม่มี []

                
            }else{
                echo "result_shareshow is false ".mysqli_error($link)."\n" ;
            }       
}

mysqli_close($link);

?>