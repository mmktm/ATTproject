<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code show data content นั้นๆ
//รับค่า ID_Content ($_POST['ID_Content'])

if(isset($_POST['ID_Content']) && $_POST['ID_Content'] != '' ){
    header('Content-type: application/json');

    $idcontentshow = $_POST['ID_Content'] ;

    $sql_ctshow = " SELECT 
                        `user`.ID_User,
                        `user`.Username,
                        post.Status_Post,
                        content.ID_Content,
                        content.Date_Content,
                        content.Text_NameContent,
                        content.Text_Content,
                        content.Link_VDO,
                        content.Link_Map,
                        content.Counter_Read,
                        content.Images01,
                        content.Images02,
                        content.Images03,
                        content.Images04,
                        content.Images05,
                        content.Images06,
                        content.Images07,
                        content.Images08,
                        content.Images09,
                        content.Images10,
                        cate1.Name_Category AS Cate1,
                        cate2.Name_Category AS Cate2,
                        cate3.Name_Category AS Cate3 
                    FROM
                        (((((( content
                                LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category )
                                LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category )
                                RIGHT JOIN post ON content.ID_Content = post.ID_Content )
                                JOIN `user` ON post.ID_User = `user`.ID_User )
                                
                    WHERE
                        content.ID_Content = '$idcontentshow' && post.Status_Post = 'Post' " ;
        
        $result_ctshow = $link->query($sql_ctshow);
        if($result_ctshow){
            $row_ctshow = $result_ctshow->fetch_assoc() ;
            $output_ctshow[] = $row_ctshow ;
            $j_ctshow = json_encode($output_ctshow);
            echo "$j_ctshow\n" ;
        } else {
            echo "result_ctshow is false ".mysqli_error($link)."\n" ;
            
        }
}

mysqli_close($link);

?>