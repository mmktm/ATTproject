
<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //มีตัวแปร iduser รับค่า ID_User เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['iduser']) && $_GET['iduser'] != ''){
        //รับค่า ID_User
		$iduser = $_GET['iduser'];
        
        //hiddencontent เรียงลำดับจากid บทความ ล่าสุด
        $sql_detailreport = " SELECT
                                    `user`.ID_User,
                                    `user`.Username,
                                    content.ID_Content,
                                    content.Title,
                                    content.Status_Content,
                                    content.Cause
                            FROM 
                                `user` LEFT JOIN content ON `user`.ID_User = content.ID_Author
                            WHERE 
                                `user`.ID_User = $iduser AND content.Status_Content = 'hidden'
                            ORDER BY
                                content.ID_Content DESC" ; //เรียงตาม idcontent

            $result_detailreport = $link->query($sql_detailreport);
            if($result_detailreport->num_rows <=0 ){
                echo json_encode("No DetailContent Report");
            } else {
                while ($row_detailreport = $result_detailreport->fetch_assoc()){
                    // $statusrp = $row_detailreport['Status_Report'];
                    //     if($statusrp == null){
                    //         $statusrp = ' ' ;
                    //         $row_detailreport['Status_Report'] = $statusrp;
                    //     }
                    $output_detailreport[] = $row_detailreport ;
                    $j_detailreport = json_encode($output_detailreport,JSON_NUMERIC_CHECK);
                }
                echo "$j_detailreport\n" ;
            }
    }
    mysqli_close($link);
?>