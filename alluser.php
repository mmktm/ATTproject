<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ไม่กรองblock

    //มีตัวแปร alluser เข้ามา
    if(isset($_GET['alluser'])) {

        //select จำนวน user ทั้งหมด
        $sql_toteluser = "SELECT ID_User FROM `user`ORDER BY ID_User DESC LIMIT 1";

        $result_toteluser = $link->query($sql_toteluser);
        $row_toteluser = $result_toteluser->fetch_assoc();//assocเลือกค่าเดียว
        $toteluser = $row_toteluser['ID_User'] ;//ค่า toteluser ที่ select ได้

        // echo $toteluser."\n";

        for($i=1 ; $i <= $toteluser ; $i++){

        //show datauser : ID_User,Username,Status_User,followers,following,date,email
        $sql_alluser = " SELECT
                            `user`.ID_User,
                            `user`.Username,
                            `user`.Image,
                            `user`.Status_User,
                            SUM(CASE WHEN follow.ID_Following = $i THEN 1 ELSE 0 END) AS follower,
                            SUM(CASE WHEN follow.ID_User = $i THEN 1 ELSE 0 END) AS following,
                            `user`.Date_User,
                            `user`.Email
                        FROM
                            `follow`
                            JOIN `user` ON `user`.ID_User = $i
                        WHERE
                            (`follow`.ID_User = $i OR follow.ID_Following = $i) AND follow.Status_Follow = '1' " ;

            $result_alluser = $link->query($sql_alluser);
            if($result_alluser->num_rows <=0 ){
                echo "Not found\n" ;
            } else {
                while ($row_alluser = $result_alluser->fetch_assoc()){
                    $output_alluser[] = $row_alluser ;
                    $j_alluser = json_encode($output_alluser,JSON_NUMERIC_CHECK);
                }
            }
        }
        echo "$j_alluser\n" ; //นอกลูป
         
    }
    mysqli_close($link);
?> 