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
                            (`follow`.ID_User = $i OR follow.ID_Following = $i)
                            AND follow.Status_Follow = 'followed' " ;

            $result_alluser = $link->query($sql_alluser);
            if($result_alluser->num_rows <=0 ){
                echo "No user\n" ;
            } else {
                while ($row_alluser = $result_alluser->fetch_assoc()){
                    // $output_alluser[] = $row_alluser ;
                    // $j_alluser = json_encode($output_alluser,JSON_NUMERIC_CHECK);
                    
                    $follower = $row_alluser['follower']; //data follower
                    $following = $row_alluser['following'];
                    // echo $follower."\n"; //จำนวน follower
                    if( ($follower==null) or ($following==null) ){ //ถ้าfollower or following have null
                        $follower = 0 ;
                        $following = 0 ;
                        $row_alluser['follower'] = $follower ;
                        $row_alluser['following'] = $following ;
                    }
                    $output_alluser[] = $row_alluser ;
                    $j_alluser = json_encode($output_alluser,JSON_NUMERIC_CHECK);
                    // echo "$j_alluser\n";
                }
            }

        $sql_totalctbyuser = "  SELECT 
                                    `user`.ID_User,
				                    `user`.Username,
				                    COUNT(content.ID_Content) AS totalcontent,
                                    SUM( CASE WHEN content.Status_Content = 'posted' THEN 1 ELSE 0 END ) AS totalpost,
                                    SUM( CASE WHEN content.Status_Content = 'deleted' THEN 1 ELSE 0 END ) AS totaldelete,
                                    SUM( CASE WHEN content.Status_Content = 'hidden' THEN 1 ELSE 0 END ) AS totalreport
                                FROM
		                            `user`
                            		LEFT JOIN content ON `user`.ID_User = content.ID_Author
                                WHERE
                                    user.ID_User = $i
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
            }
            // echo "$j_alluser\n" ; //นอกลูป
            // echo "$j_totalctbyuser\n" ;     
        
    }//loop for
    echo "$j_alluser\n" ; //นอกลูป
    echo "$j_totalctbyuser\n" ;
}//get
    mysqli_close($link);
?> 