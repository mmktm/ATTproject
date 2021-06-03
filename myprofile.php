
<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร profile รับค่า ID_User เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['profile']) && $_GET['profile'] != ''){
        //รับค่า ID_User
		$profile = $_GET['profile'];
        
        //show datauser : ID_User,Date_User,Username,Status_User,Image,followers
        $sql_profile = " SELECT
                            `user`.ID_User,
                            `user`.Username,
                            `user`.Image,
                            `user`.Status_User,
                            SUM(CASE WHEN follow.ID_Following = $profile THEN 1 ELSE 0 END) AS follower,
                            SUM(CASE WHEN follow.ID_User = $profile THEN 1 ELSE 0 END) AS following,
                            `user`.Date_User,
                            `user`.Email
                        FROM
                            `follow`
                            JOIN `user` ON `user`.ID_User = $profile
                        WHERE
                            ( `follow`.ID_User = $profile OR follow.ID_Following = $profile ) 
                            AND follow.Status_Follow = '1' " ;

            $result_profile = $link->query($sql_profile);
            if($result_profile->num_rows <=0 ){
                echo "Not found this ID_user : $profile " ;
            } else {
                while ($row_profile = $result_profile->fetch_assoc()){
                    // $output_profile[] = $row_profile ;
                    // $j_profile = json_encode($output_profile,JSON_NUMERIC_CHECK);
                    
                    $follower = $row_profile['follower']; //data follower
                    $following = $row_profile['following'];
                    // echo $follower."\n"; //จำนวน follower
                    if( ($follower==null) or ($following==null) ){ //ถ้าfollower or following have null
                        $follower = 0 ;
                        $following = 0 ;
                        $row_profile['follower'] = $follower ;
                        $row_profile['following'] = $following ;
                    }
                    $output_profile[] = $row_profile ;
                    $j_profile = json_encode($output_profile,JSON_NUMERIC_CHECK);
                }
                echo "$j_profile\n" ;
            }
        
        //following
        // $sql_following = " SELECT
        //                         COUNT( ID_User ) AS following 
        //                     FROM
        //                         follow 
        //                     WHERE
        //                         ID_User = $profile 
        //                         AND Status_Follow =1 " ;

        //     $result_following = $link->query($sql_following);
        //     if($result_following->num_rows <=0 ){
        //         echo "Not found this ID_user : $following " ;
        //     } else {
        //         while ($row_following = $result_following->fetch_assoc()){
        //             $output_following[] = $row_following ;
        //             $j_following = json_encode($output_following,JSON_NUMERIC_CHECK);
        //         }
        //         echo "$j_following\n" ;
        //     }

        //contentof เรียงลำดับจากid บทความ ล่าสุด
        // $sql_contentof = " SELECT
        //                         `user`.ID_User,
        //                         `user`.Username,
        //                         post.Status_Post,
        //                         content.ID_Content,
        //                         content.Date_Content,
        //                         content.Time_Content,
        //                         content.Title,
        //                         category.Category,
        //                         content.Content,
        //                         content.Link_VDO,
        //                         content.Location,
        //                         content.Counter_Read,
        //                         content.Images01,
        //                         content.Images02,
        //                         content.Images03,
        //                         content.Images04
                                
        //                     FROM
        //                         (((( content
        //                             LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
        //                             LEFT JOIN category ON con_in_cate.ID_Category = category.ID_Category )
        //                             RIGHT JOIN post ON content.ID_Content = post.ID_Content )
        //                             JOIN `user` ON post.ID_User = `user`.ID_User )
        //                     WHERE
        //                         post.ID_User = $profile && content.Status_Content = 'Post'
        //                     ORDER BY
        //                         content.ID_Content DESC" ;

        //     $result_contentof = $link->query($sql_contentof);
        //     if($result_contentof->num_rows <=0 ){
        //         echo json_encode("No Content Data");
        //     } else {
        //         while ($row_contentof = $result_contentof->fetch_assoc()){
        //             $output_contentof[] = $row_contentof ;
        //             $j_contentof = json_encode($output_contentof,JSON_NUMERIC_CHECK);
        //         }
        //         echo "$j_contentof\n" ;
        //     }
    }
    mysqli_close($link);
?>