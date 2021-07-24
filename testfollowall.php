
<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//followalluser version old and bug[nodata = null]

if(isset($_POST['followalluser'])) { // มีตัวแปร followalluser comein

    //select จำนวน user ทั้งหมด
    $sql_toteluser = "SELECT ID_User FROM `user` ORDER BY ID_User DESC LIMIT 1";

    $result_toteluser = $link->query($sql_toteluser);
    $row_toteluser = $result_toteluser->fetch_assoc();//assocเลือกใช้ค่าแบบชื่อคอลัมอย่างเดียว
    $toteluser = $row_toteluser['ID_User'] ;//ค่า toteluser ที่ select ได้

    // echo $toteluser."\n";

    for($i=1 ; $i <= $toteluser ; $i++){
    
    //
    $sql_followalluser = "SELECT
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
                                (`follow`.ID_User = '$i' OR follow.ID_Following = '$i' )
                                AND follow.Status_Follow = 'followed'";

    $result_followalluser = $link->query($sql_followalluser);

    if($result_followalluser->num_rows <=0 ){
        echo "No following and follower in ID_User $i\n" ;
    } else {
        while ($row_followalluser = $result_followalluser->fetch_assoc()){
        $output_followalluser[] = $row_followalluser ;
        $j_followalluser = json_encode($output_followalluser,JSON_NUMERIC_CHECK);
        // $totalfav = $row_followalluser['fav'];
        }
        // echo json_encode($totalfav,JSON_NUMERIC_CHECK); //แค่ตัวเลข
        // echo $j_followalluser; //ติดloop 1 12 123
    }
}echo $j_followalluser;
}
mysqli_close($link);
?> 