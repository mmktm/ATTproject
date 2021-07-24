<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code show data content นั้นๆ
//รับค่า ID_Content ($_POST['ID_Content'])

if(isset($_POST['ID_Content']) && $_POST['ID_Content'] != '' ){

    $idcontentshow = $_POST['ID_Content'] ;

    $sql_ctshow = " SELECT
                        `user`.ID_User,
                        `user`.Username,
                        post.Status_Post,
                        content.ID_Content,
                        content.Date_Content,
                        content.Time_Content,
                        content.Title,
                        cate.Category AS cate,
                        cate2.Category AS cate2,
                        cate3.Category AS cate3,
                        content.Content,
                        content.Link_VDO,
                        content.Location,
                        content.Counter_Read,
                        content.Images01,
                        content.Images02,
                        content.Images03,
                        content.Images04
                    FROM
                        content
                        LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content
                        LEFT JOIN category cate ON con_in_cate.ID_Category = cate.ID_Category
                        LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category
                        LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category
                        RIGHT JOIN post ON content.ID_Content = post.ID_Content
                        JOIN `user` ON post.ID_User = `user`.ID_User             
                    WHERE
                        content.ID_Content = '$idcontentshow' && content.Status_Content = 'posted' " ;
        
        $result_ctshow = $link->query($sql_ctshow);
        if($result_ctshow){
            $row_ctshow = $result_ctshow->fetch_assoc() ;
            $output_ctshow[] = $row_ctshow ;
            $j_ctshow = json_encode($output_ctshow,JSON_NUMERIC_CHECK);
            echo "$j_ctshow\n" ;
        } else {
            echo "result_ctshow is false ".mysqli_error($link)."\n" ;
            
        }
}

mysqli_close($link);

?>