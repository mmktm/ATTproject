<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //รับค่า ID_Content
    if(isset($_POST['idctreport']) && $_POST['idctreport'] != '' ) {

		$idctreport = $_POST['idctreport'];
        
        $sql_reportshow = " SELECT * FROM report WHERE ID_Content = '$idctreport'" ;

        $result_reportshow = $link->query($sql_reportshow);
        if($result_reportshow->num_rows <=0 ){
            echo "บทความนี้ไม่ถูก report" ;
        } else {
            while ($row_reportshow = $result_reportshow->fetch_assoc()){
                $output_reportshow[] = $row_reportshow ;
                $j_reportshow = json_encode($output_reportshow,JSON_NUMERIC_CHECK);
            }
            // echo "$result_reportshow->num_rows\n";
            echo "$j_reportshow\n" ;
        }
    }
    mysqli_close($link);
?>