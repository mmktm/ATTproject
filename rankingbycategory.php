<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร rankbycategory รับค่า ID_category เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['rankbycategory']) && $_GET['rankbycategory'] != ''){

        //ตัวแปรรับค่า ID_category
		$rankbycategory = $_GET['rankbycategory'];
        
        $sql_rankbycategory = " SELECT
                                --     content.Counter_Read,
                                --     content.ID_Content,
                                --     content.Date_Content,
                                --     content.Time_Content,
                                --     content.Status_Content,
                                --     content.Title,
                                --     content.Content,
                                --     content.Link_VDO,
                                --     content.Location,
                                --     content.Images01,
                                --     content.Images02,
                                --     content.Images03,
                                --     content.Images04,
                                --     con_in_cate.ID_Category,
                                --     category.Category
                                -- FROM
                                --     content 
                                --     INNER JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content
                                --     LEFT JOIN category ON con_in_cate.ID_Category = category.ID_Category 
                                `user`.ID_User,
                                `user`.Username,
                                 post.Status_Post,
                                 content.ID_Content,
                                 content.Date_Content,
                                 content.Time_Content,
                                 content.Title,
                                 category.Category,
                                 content.Content,
                                 content.Link_VDO,
                                 content.Location,
                                 content.Counter_Read,
                                 content.Images01,
                                 content.Images02,
                                 content.Images03,
                                 content.Images04,
                                 content.Total_Fav,
                                 content.Total_Com,
                                 content.Total_Save,
                                 content.Total_Share
                                
                             FROM
                                 (((( content
                                     LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                     LEFT JOIN category ON con_in_cate.ID_Category = category.ID_Category )
                                     RIGHT JOIN post ON content.ID_Content = post.ID_Content )
                                     JOIN `user` ON post.ID_User = `user`.ID_User )
                                WHERE
                                    con_in_cate.ID_Category = $rankbycategory 
                                    AND content.Status_Content = 'posted'
                                ORDER BY
	                                content.Counter_Read DESC  
                                    LIMIT 10   " ;

        $result_rankbycategory = $link->query($sql_rankbycategory);
        if($result_rankbycategory->num_rows <=0 ){
            echo "ไม่พบบทความเกี่ยวกับ ID_Category : $rankbycategory น้า" ;
        } else {
            while ($row_rankbycategory = $result_rankbycategory->fetch_assoc()){
                $output_rankbycategory[] = $row_rankbycategory ;
                $j_rankbycategory = json_encode($output_rankbycategory,JSON_NUMERIC_CHECK);
            }
            echo "$j_rankbycategory\n" ;
        }

    }
    mysqli_close($link);
?>