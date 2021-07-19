<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดตัวแปร reportshowall
    if(isset($_POST['reportshowall'])) {

		$reportshowall = $_POST['reportshowall'];
        
        $sql_reportshowall = " SELECT * FROM report 
                                ORDER BY
                                    report.Date_Report DESC" ;

        $result_reportshowall = $link->query($sql_reportshowall);
        if($result_reportshowall->num_rows <=0 ){
            echo "no report" ;
        } else {
            while ($row_reportshowall = $result_reportshowall->fetch_assoc()){
                $output_reportshowall[] = $row_reportshowall ;
                $j_reportshowall = json_encode($output_reportshowall,JSON_NUMERIC_CHECK);
            }
            // echo "$result_reportshowall->num_rows\n";
            echo "$j_reportshowall\n" ;
        }
    }
    mysqli_close($link);
?>