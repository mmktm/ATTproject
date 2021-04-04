<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร searchbycategory รับค่า ID_category เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['searchbycategory']) && $_GET['searchbycategory'] != ''){
        header('Content-type: application/json');

        //ตัวแปรรับค่า ID_category
		$searchbycategory = $_GET['searchbycategory'];
        
        $sql_searchbycategory = " SELECT
                                    content.ID_Content,
                                    content.Date_Content,
                                    content.Status_Content,
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
                                    con_in_cate.ID_Category1,
                                    con_in_cate.ID_Category2,
                                    con_in_cate.ID_Category3,
                                    cate0.Name_Category AS Cate1,
                                    cate1.Name_Category AS Cate2,
                                    cate2.Name_Category AS Cate3
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