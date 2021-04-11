<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร profile รับค่า ID_User เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['profile']) && $_GET['profile'] != ''){

        header('Content-type: application/json');
        //รับค่า ID_User
		$profile = $_GET['profile'];
        
        //show : ID_User,Date_User,Username,Status_User,Image,followers
        $sql_profile = " SELECT
                            user.ID_User,
                            user.Date_User,
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

        //contentof
        $sql_contentof = " SELECT
                                * 
                            FROM
                                post 
                                JOIN content ON post.ID_Content = content.ID_Content
                            WHERE
                                post.ID_User = $profile && content.Status_Content = 'Post' " ;

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