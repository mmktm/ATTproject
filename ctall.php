<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม home แสดงบทความทั้งหมด เรียงตามไอดีคอนเท้นล่าสุด
    if(isset($_GET['home'])){

        $sql_allcontent = " SELECT 
                                `user`.ID_User,
                                `user`.Username,
                                post.Status_Post,
                                content.ID_Content,
                                content.Date_Content,
                                content.Time_Content,
                                content.Title,
                                content.Content,
                                content.Link_VDO,
                                content.Location,
                                content.Counter_Read,
                                content.Images01,
                                -- content.Images02,
                                -- content.Images03,
                                -- content.Images04,
                                cate1.Category AS Cate1
                                -- cate2.Category AS Cate2,
                                -- \cate3.Category AS Cate3 
                            FROM
                                (((( content
                                        LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                        LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                        -- LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category )
                                        -- LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category )
                                        RIGHT JOIN post ON content.ID_Content = post.ID_Content )
                                        JOIN `user` ON post.ID_User = `user`.ID_User )
                                        
                            WHERE
                                post.Status_Post = 'Post' 
                            ORDER BY
                                content.ID_Content DESC " ;

            $result_allcontent = $link->query($sql_allcontent);
                if($result_allcontent->num_rows <=0 ){
                    echo "ไม่พบบทความ" ;
                } else {
                    while ($row_allcontent = $result_allcontent->fetch_assoc()){
                        $output_allcontent[] = $row_allcontent ;
                        $j_allcontent = json_encode($output_allcontent);
                    }
                    echo "$j_allcontent\n" ;
                }

    }
    mysqli_close($link);

?>