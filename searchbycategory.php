<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร searchbycategory รับค่า ID_category เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['searchbycategory']) && $_GET['searchbycategory'] != ''){

        //ตัวแปรรับค่า ID_category
		$searchbycategory = $_GET['searchbycategory'];
        
        $sql_searchbycategory = " SELECT
                                    content.ID_Content,
                                    content.Date_Content,
                                    content.Time_Content,
                                    content.Status_Content,
                                    content.Title,
                                    content.Content,
                                    content.Link_VDO,
                                    content.Location,
                                    content.Counter_Read,
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
                                   ( con_in_cate.ID_Category1 = $searchbycategory 
                                    OR con_in_cate.ID_Category2 = $searchbycategory 
                                    OR con_in_cate.ID_Category3 = $searchbycategory ) 
                                    AND Status_Content = 'Post' " ;

        $result_searchbycategory = $link->query($sql_searchbycategory);
        if($result_searchbycategory->num_rows <=0 ){
            echo "ไม่พบบทความเกี่ยวกับ ID_Category : $searchbycategory น้า" ;
        } else {
            while ($row_searchbycategory = $result_searchbycategory->fetch_assoc()){
                $output_searchbycategory[] = $row_searchbycategory ;
                $j_searchbycategory = json_encode($output_searchbycategory);
            }
            echo "$j_searchbycategory\n" ;
        }

        }
        mysqli_close($link);
?>       