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
                            user.ID_User,
                            user.Date_User,
                            user.Time_User,
                            user.Username,
                            user.Status_User,
                            user.Image,
                            COUNT( follow.ID_Following ) AS followers
                        FROM
                            user
                            JOIN follow ON user.ID_User = follow.ID_Following
                        WHERE
                            user.ID_User = $profile AND follow.Status_Follow = 1
                        GROUP BY
                            follow.Status_Follow " ;

            $result_profile = $link->query($sql_profile);
            if($result_profile->num_rows <=0 ){
                echo "Not found this ID_user : $profile " ;
            } else {
                while ($row_profile = $result_profile->fetch_assoc()){
                    $output_profile[] = $row_profile ;
                    $j_profile = json_encode($output_profile);
                }
                echo "$j_profile\n" ;
            }
        
        //following
        $sql_following = " SELECT
                                COUNT( ID_User ) AS following 
                            FROM
                                follow 
                            WHERE
                                ID_User = $profile 
                                AND Status_Follow =1 " ;

            $result_following = $link->query($sql_following);
            if($result_following->num_rows <=0 ){
                echo "Not found this ID_user : $following " ;
            } else {
                while ($row_following = $result_following->fetch_assoc()){
                    $output_following[] = $row_following ;
                    $j_following = json_encode($output_following);
                }
                echo "$j_following\n" ;
            }

        //contentof เรียงลำดับจากid บทความ ล่าสุด
        $sql_contentof = " SELECT
                                `user`.ID_User,
                                `user`.Username,
                                post.Status_Post,
                                content.ID_Content,
                                content.Date_Content,
                                content.Time_Content,
                                content.Title,
                                content.Content,
                                content.Link_VDO,
                                content.Location,
                                content.Counter_Read,
                                content.Images01,
                                content.Images02,
                                content.Images03,
                                content.Images04,
                                cate1.Category AS Cate1,
                                cate2.Category AS Cate2,
                                cate3.Category AS Cate3 
                            FROM
                                (((((( content
                                    LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                    LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                    LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category )
                                    LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category )
                                    RIGHT JOIN post ON content.ID_Content = post.ID_Content )
                                    JOIN `user` ON post.ID_User = `user`.ID_User )
                            WHERE
                                post.ID_User = $profile && content.Status_Content = 'Post'
                            ORDER BY
                                content.ID_Content DESC" ;

            $result_contentof = $link->query($sql_contentof);
            if($result_contentof->num_rows <=0 ){
                echo "Not found this ID_user : $contentof " ;
            } else {
                while ($row_contentof = $result_contentof->fetch_assoc()){
                    $output_contentof[] = $row_contentof ;
                    $j_contentof = json_encode($output_contentof);
                    
                }
                echo "$j_contentof\n" ;
            }
    }
    mysqli_close($link);
?>