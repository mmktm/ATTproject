<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

if(isset($_GET['totalcontent'])) {

    $sql_totalcontent = "SELECT ID_Content AS totalcontent 
                        FROM `content`ORDER BY ID_Content DESC LIMIT 1";

    $result_totalcontent = $link->query($sql_totalcontent);

    if($result_totalcontent->num_rows <=0 ){
        echo "No content\n" ;
    } else {
        while ($row_totalcontent = $result_totalcontent->fetch_assoc()){
        $output_totalcontent[] = $row_totalcontent ;
        $j_totalcontent = json_encode($output_totalcontent,JSON_NUMERIC_CHECK);
        }
        echo $j_totalcontent;
    }
}
mysqli_close($link);
?> 