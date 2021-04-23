<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม home แสดงบทความทั้งหมด เรียงตามไอดีคอนเท้นล่าสุด
    if(isset($_GET['home'])){
        header('Content-type: application/json');

        //idcontentสุดท้าย
        $sql_maxidcontent = " SELECT MAX(ID_Content) AS maxidct FROM content ";
            $result_maxidcontent = $link->query($sql_maxidcontent);
                if($result_maxidcontent){
                    $row_maxidcontent = $result_maxidcontent->fetch_assoc();
                    $maxidct = $row_maxidcontent['maxidct'];
                }else{
                    echo " result_maxidcontent is false".mysqli_error($link)."\n" ;
                }

                for( $i=$maxidct ; $i >= 1 ; $i-- ){

                    $sql_allcontent = " SELECT 
                        `user`.ID_User,
                        `user`.Username,
                        post.Status_Post,
                        content.ID_Content,
                        content.Date_Content,
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
                        cate1.Name_Category AS Cate1,
                        cate2.Name_Category AS Cate2,
                        cate3.Name_Category AS Cate3 
                    FROM
                        (((((( content
                                LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category )
                                LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category )
                                RIGHT JOIN post ON content.ID_Content = post.ID_Content )
                                JOIN `user` ON post.ID_User = `user`.ID_User )
                                
                    WHERE
                        content.ID_Content = '$i' && post.Status_Post = 'Post'
                    -- ORDER BY
                    --     content.ID_Content DESC " ;

                        $result_allcontent = $link->query($sql_allcontent);
                            $row_allcontent = $result_allcontent->fetch_assoc();
                            // $output_allcontent[] = $row_allcontent ;
                            $j_allcontent = json_encode($row_allcontent);
                            echo "$j_allcontent\n" ;
                            // print_r($j_allcontent);

                    $sql_fav = "SELECT COUNT(ID_User) AS fav FROM favorite WHERE ID_Content = '$i' && Status_Fav = '1' " ;
                        $result_fav = $link->query($sql_fav);
                            $row_fav = $result_fav->fetch_assoc();
                            // $output_fav[] = $row_fav ;
                            $j_fav = json_encode($row_fav);
                            echo "$j_fav\n" ;
                            // print_r($j_fav);
            }



        // $sql_allcontent = " SELECT 
        //                         `user`.ID_User,
        //                         `user`.Username,
        //                         post.Status_Post,
        //                         content.ID_Content,
        //                         content.Date_Content,
        //                         content.Text_NameContent,
        //                         content.Text_Content,
        //                         content.Link_VDO,
        //                         content.Link_Map,
        //                         content.Counter_Read,
        //                         content.Images01,
        //                         content.Images02,
        //                         content.Images03,
        //                         content.Images04,
        //                         content.Images05,
        //                         content.Images06,
        //                         content.Images07,
        //                         content.Images08,
        //                         content.Images09,
        //                         content.Images10,
        //                         cate1.Name_Category AS Cate1,
        //                         cate2.Name_Category AS Cate2,
        //                         cate3.Name_Category AS Cate3 
        //                     FROM
        //                         (((((( content
        //                                 LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
        //                                 LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
        //                                 LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category )
        //                                 LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category )
        //                                 RIGHT JOIN post ON content.ID_Content = post.ID_Content )
        //                                 JOIN `user` ON post.ID_User = `user`.ID_User )
                                        
        //                     WHERE
        //                         post.Status_Post = 'Post' 
        //                     ORDER BY
        //                         content.ID_Content DESC " ;

        //     $result_allcontent = $link->query($sql_allcontent);
        //         if($result_allcontent->num_rows <=0 ){
        //             echo "ไม่พบบทความ" ;
        //         } else {
        //             while ($row_allcontent = $result_allcontent->fetch_assoc()){
        //                 $output_allcontent[] = $row_allcontent ;
        //                 $j_allcontent = json_encode($output_allcontent);
        //             }
        //             echo "$j_allcontent\n" ;
        //         }

    }
    mysqli_close($link);

?>