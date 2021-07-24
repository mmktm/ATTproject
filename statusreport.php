<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//เปลี่ยนสถานะ report-table จาก reported -> checked โดยรับค่าจาก idreport

    //input id-report
    if(isset($_POST['ID_Report']) && $_POST['ID_Report'] != '') {
        
        $ID_Report = $_POST['ID_Report']; //idreport
        $statusrp = 'checked';
        
                    //Statusreport edit (update)
                    $sql_statusrp = " UPDATE report SET Status_Report = '$statusrp' WHERE ID_Report = '$ID_Report' && Status_Report = 'reported'" ;
                
                        $result_statusrp = $link->query($sql_statusrp);
                        // echo "$result_statusrp";

                            if($result_statusrp == '1'){
                                echo "reported -> checked is success \n"; }
                            else{
                                echo "reported -> checked is false ".mysqli_error($link)."\n" ;
                            }
            }else{echo "error idreport" ; }
    
    mysqli_close($link);

    ?>