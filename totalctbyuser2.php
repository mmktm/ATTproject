<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม plus แสดงจำนวนบทความของแต่ละ user and status content = posted

    if(isset($_GET['plus'])){

        //select จำนวน user ทั้งหมด
        $sql_toteluser = "SELECT ID_User FROM `user` ORDER BY ID_User DESC LIMIT 1";

        $result_toteluser = $link->query($sql_toteluser);
        $row_toteluser = $result_toteluser->fetch_assoc();//assocเลือกใช้ค่าแบบชื่อคอลัมอย่างเดียว
        $toteluser = $row_toteluser['ID_User'] ;//ค่า toteluser ที่ select ได้

        // echo $toteluser."\n";

    for($i=1 ; $i <= $toteluser ; $i++){

        $sql_totalctbyuser2 = " SELECT 
                                    `user`.ID_User,
				                    `user`.Username,
				                    SUM(CASE WHEN content.ID_Author = $i THEN 1	ELSE 0 END) AS total
                                FROM
                                    `user`
                                    LEFT JOIN content ON `user`.ID_User = $i
                                WHERE
                                    content.Status_Content = 'posted' " ;

            $result_totalctbyuser2 = $link->query($sql_totalctbyuser2);
                if($result_totalctbyuser2->num_rows <=0 ){
                    echo "error" ;
                } else {
                    while ($row_totalctbyuser2 = $result_totalctbyuser2->fetch_assoc()){
                        $output_totalctbyuser2[] = $row_totalctbyuser2 ;
                        $j_totalctbyuser2 = json_encode($output_totalctbyuser2,JSON_NUMERIC_CHECK);
                    }
                    // echo "$j_totalctbyuser2\n" ;
                }
            } echo "$j_totalctbyuser2\n" ;
    }
    mysqli_close($link);

?>
