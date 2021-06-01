<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

if(isset($_GET['totaluser'])) {

    $sql_totaluser = "SELECT ID_User AS totaluser 
                        FROM `user`ORDER BY ID_User DESC LIMIT 1";

    $result_totaluser = $link->query($sql_totaluser);

    if($result_totaluser->num_rows <=0 ){
        echo "No user\n" ;
    } else {
        while ($row_totaluser = $result_totaluser->fetch_assoc()){
        // $output_totaluser[] = $row_totaluser ;
        // $j_totaluser = json_encode($output_totaluser,JSON_NUMERIC_CHECK);
        $totaluser = $row_totaluser['totaluser'];
        }
        echo json_encode($totaluser,JSON_NUMERIC_CHECK); //แค่ตัวเลข
        // echo $j_totaluser;
    }
}
mysqli_close($link);
?> 