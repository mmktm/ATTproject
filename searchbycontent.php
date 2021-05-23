<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร searchbycontent รับค่า คำค้นหา เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['searchbycontent']) && $_GET['searchbycontent'] != ''){

        //ตัวแปรรับค่าการค้นหาบทความ
		$searchbycontent = $_GET['searchbycontent'];
        
        $sql_searchbycontent = " SELECT
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
                                WHERE content.Status_Content = 'Post' AND content.Title LIKE '%{$searchbycontent}%' " ;

        $result_searchbycontent = $link->query($sql_searchbycontent);
        if($result_searchbycontent->num_rows <=0 ){
            echo "ไม่พบบทความชื่อ $searchbycontent น้า" ;
        } else {
            while ($row_searchbycontent = $result_searchbycontent->fetch_assoc()){
                $output_searchbycontent[] = $row_searchbycontent ;
                $j_searchbycontent = json_encode($output_searchbycontent,JSON_NUMERIC_CHECK);
                
            }
            echo "$j_searchbycontent\n" ;

        }
    }

    mysqli_close($link);
?>