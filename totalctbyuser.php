<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม plus แสดงจำนวนบทความของแต่ละ user โดยไม่กรองสถานะบทความ
    //total นับทั้งหมด ทุกสถานะ
    if(isset($_GET['plus'])){

        $sql_totalctbyuser = " SELECT 
                                    `user`.ID_User,
				                    `user`.Username,
				                    COUNT(content.ID_Content) AS total
                                FROM
		                            `user`
                            		LEFT JOIN content ON `user`.ID_User = content.ID_Author
                                GROUP BY
		                            `user`.ID_User" ;

            $result_totalctbyuser = $link->query($sql_totalctbyuser);
                if($result_totalctbyuser->num_rows <=0 ){
                    echo "error" ;
                } else {
                    while ($row_totalctbyuser = $result_totalctbyuser->fetch_assoc()){
                        $output_totalctbyuser[] = $row_totalctbyuser ;
                        $j_totalctbyuser = json_encode($output_totalctbyuser,JSON_NUMERIC_CHECK);
                    }
                    echo "$j_totalctbyuser\n" ;
                }

    }
    mysqli_close($link);

?>