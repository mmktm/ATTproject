<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร rankbycategory รับค่า ID_category เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['rankbycategory']) && $_GET['rankbycategory'] != ''){

        //ตัวแปรรับค่า ID_category
		$rankbycategory = $_GET['rankbycategory'];
        
        $sql_rankbycategory = " SELECT
                                    content.Counter_Read,
                                    content.ID_Content,
                                    content.Date_Content,
                                    content.Time_Content,
                                    content.Status_Content,
                                    content.Title,
                                    content.Content,
                                    content.Link_VDO,
                                    content.Location,
                                    content.Images01,
                                    content.Images02,
                                    content.Images03,
                                    content.Images04,
                                    con_in_cate.ID_Category1,
                                    con_in_cate.ID_Category2,
                                    con_in_cate.ID_Category3,
                                    cate1.Category AS Cate1,
                                    cate2.Category AS Cate2,
                                    cate3.Category AS Cate3
                                FROM
                                    (((content INNER JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                    left JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                    left JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category)
                                    left JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category 
                                WHERE
                                    ( con_in_cate.ID_Category1 = $rankbycategory 
                                    OR con_in_cate.ID_Category2 = $rankbycategory 
                                    OR con_in_cate.ID_Category3 = $rankbycategory )
                                    AND Status_Content = 'Post'
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