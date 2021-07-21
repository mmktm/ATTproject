<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //รับค่า ID_Content
    if(isset($_GET['idctreport']) && $_GET['idctreport'] != '' ) {

		$idctreport = $_GET['idctreport'];
        
        // $sql_reportshow = " SELECT * FROM report WHERE ID_Content = '$idctreport'" ;
        $sql_reportshow = " SELECT * FROM report 
                                    INNER JOIN content ON report.ID_Content = content.ID_Content 
                            WHERE report.ID_Content = '$idctreport'" ;

        $result_reportshow = $link->query($sql_reportshow);
        if($result_reportshow->num_rows <=0 ){
            echo "no report" ;
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