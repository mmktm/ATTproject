<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม plus แสดงชื่อบทความทั้งหมด ยอดนับตาม status = post
    if(isset($_GET['plus'])){

        $sql_allcate = " SELECT
                                category.ID_Category,
                                category.Category,
                                SUM(CASE WHEN post.Status_Post = 'Post' THEN 1 ELSE 0 END ) AS Total
                                -- COUNT( con_in_cate.ID_Content ) AS total
                         FROM
                                category
                                LEFT JOIN con_in_cate ON category.ID_Category = con_in_cate.ID_Category
                                LEFT JOIN post ON con_in_cate.ID_Content = post.ID_Content
                         GROUP BY
                                category.ID_Category " ;

            $result_allcate = $link->query($sql_allcate);
                if($result_allcate->num_rows <=0 ){
                    echo "error" ;
                } else {
                    while ($row_allcate = $result_allcate->fetch_assoc()){
                        $output_allcate[] = $row_allcate ;
                        $j_allcate = json_encode($output_allcate,JSON_NUMERIC_CHECK);
                    }
                    echo "$j_allcate\n" ;
                }

    }
    mysqli_close($link);

?>