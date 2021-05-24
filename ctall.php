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
                                category.Category,
                                content.Content,
                                content.Link_VDO,
                                content.Location,
                                content.Counter_Read,
                                content.Images01
                                -- content.Images02,
                                -- content.Images03,
                                -- content.Images04,
                                
                            FROM
                                (((( content
                                        LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                        LEFT JOIN category ON con_in_cate.ID_Category = category.ID_Category )
                                        RIGHT JOIN post ON content.ID_Content = post.ID_Content )
                                        JOIN `user` ON post.ID_User = `user`.ID_User )
                                        
                            WHERE
                                post.Status_Post = 'Post' 
                            ORDER BY
                                content.ID_Content DESC " ; //เรียงจากctล่าสุด

            $result_allcontent = $link->query($sql_allcontent);
                if($result_allcontent->num_rows <=0 ){
                    echo "No Content" ; //no content
                } else {
                    while ($row_allcontent = $result_allcontent->fetch_assoc()){
                        $output_allcontent[] = $row_allcontent ;
                        $j_allcontent = json_encode($output_allcontent,JSON_NUMERIC_CHECK);
                    }
                    echo "$j_allcontent\n" ;
                }

    }
    mysqli_close($link);

?>