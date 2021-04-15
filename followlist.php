<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //มีค่า ID_User เข้ามา
    if(isset($_GET['followerlist']) && $_GET['followerlist'] != ''){
        header('Content-type: application/json');

        $iduser = $_GET['followerlist'] ;

        $sql_followerlist = " SELECT
                                    -- follow.ID_User,
                                    -- follow.ID_Following,
                                    -- follow.Status_Follow,
                                    -- follow.Date_Follow,
                                    -- `user`.Username,
                                    -- `user`.Status_User
                                    `user`.Username
                                FROM 
                                    follow JOIN `user` ON `user`.ID_User = follow.ID_User
                                    WHERE follow.Status_Follow = '1' && `user`.Status_User = 'Active' && follow.ID_Following = '$iduser'" ;
            
            $result_followerlist = $link->query($sql_followerlist);
                if($result_followerlist->num_rows <=0 ){
                    echo "ไม่มีผู้ติดตาม" ;
                } else {
                    while ($row_followerlist = $result_followerlist->fetch_assoc()){
                        $output_followerlist[] = $row_followerlist ;
                        $j_followerlist = json_encode($output_followerlist);
                    }
                    echo "$j_followerlist\n" ;
                }
}else { 
    
    if(isset($_GET['followinglist']) && $_GET['followinglist'] != ''){
        header('Content-type: application/json');

    $iduser = $_GET['followinglist'] ;

    $sql_followinglist = " SELECT
                                -- follow.ID_User,
                                -- follow.ID_Following,
                                -- follow.Status_Follow,
                                -- follow.Date_Follow,
                                -- `user`.Username,
                                -- `user`.Status_User
                                `user`.Username
                            FROM 
                                follow JOIN `user` ON `user`.ID_User = follow.ID_Following
                                WHERE follow.Status_Follow = '1' && `user`.Status_User = 'Active' && follow.ID_User = '$iduser'" ;
        
        $result_followinglist = $link->query($sql_followinglist);
            if($result_followinglist->num_rows <=0 ){
                echo "ไม่มีผู้ติดตาม" ;
            } else {
                while ($row_followinglist = $result_followinglist->fetch_assoc()){
                    $output_followinglist[] = $row_followinglist ;
                    $j_followinglist = json_encode($output_followinglist);
                }
                echo "$j_followinglist\n" ;
            }
    }
}
mysqli_close($link);

?>