<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //รับตัวแปร content แสดงบทความทั้งหมด ทุกสถานะ เรียงตามไอดีคอนเท้นล่าสุด 
    if(isset($_GET['content'])){

        $sql_allctadmin = " SELECT 
                                `user`.ID_User,
                                `user`.Username,
                                `user`.Image,
                                content.Status_Content,
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

                            ORDER BY
                                content.ID_Content DESC " ; //เรียงจากctล่าสุด

            $result_allctadmin = $link->query($sql_allctadmin);
                if($result_allctadmin->num_rows <=0 ){
                    echo "No Content" ; //no content
                } else {
                    while ($row_allctadmin = $result_allctadmin->fetch_assoc()){
                        $output_allctadmin[] = $row_allctadmin ;
                        $j_allctadmin = json_encode($output_allctadmin,JSON_NUMERIC_CHECK);
                    }
                    echo "$j_allctadmin\n" ;
                }

    }
    mysqli_close($link);

?>