<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร searchbycontent รับค่า คำค้นหา เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['searchbycontent']) && $_GET['searchbycontent'] != ''){

        //ตัวแปรรับค่าชื่อบทความ
		$searchbycontent = $_GET['searchbycontent'];
        
        $sql_searchbycontent = " SELECT 
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
                                    content.Status_Content = 'posted' AND content.Title LIKE '%{$searchbycontent}%' " ;

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