<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร searchbycategory รับค่า ID_category เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['searchbycategory']) && $_GET['searchbycategory'] != ''){

        //ตัวแปรรับค่า ID_category
		$searchbycategory = $_GET['searchbycategory'];
        
        $sql_searchbycategory = " SELECT 
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
                                content.Latitude,
                                content.Longitude,
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
                                    con_in_cate.ID_Category = $searchbycategory
                                    AND content.Status_Content = 'posted' " ;

        $result_searchbycategory = $link->query($sql_searchbycategory);
        if($result_searchbycategory->num_rows <=0 ){
            echo "ไม่พบบทความเกี่ยวกับ ID_Category : $searchbycategory น้า" ;
        } else {
            while ($row_searchbycategory = $result_searchbycategory->fetch_assoc()){
                $output_searchbycategory[] = $row_searchbycategory ;
                $j_searchbycategory = json_encode($output_searchbycategory,JSON_NUMERIC_CHECK);
            }
            echo "$j_searchbycategory\n" ;
        }

        }
        mysqli_close($link);
?>       