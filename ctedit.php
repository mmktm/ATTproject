<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ต้องรับมา 2 ค่า id-user and id-content

    //กดปุ่ม edit รับค่า ID_content ที่ต้องการ edit เข้ามา
    if(isset($_POST['ID_Contentedit']) && $_POST['ID_Contentedit'] != '') {
        header('Content-type: application/json'); //แสดงแบบ json
        
        $ID_User = $_POST['ID_User']; //iduser
        $ID_Contentedit = $_POST['ID_Contentedit']; //idcontent
        $Text_nct = $_POST['Text_nct']; //namecontent
        $Text_ct = $_POST['Text_ct'];//text
        $Link_VDO = $_POST['Link_VDO'];//link vdo
        $Link_Map = $_POST['Link_Map'];//link map
        $ID_Category1 = $_POST['ID_Category1']; //idcategory1
        $ID_Category2 = $_POST['ID_Category2'];//idcategory2
        $ID_Category3 = $_POST['ID_Category3'];//idcategory3
        //images

        //check iduser กับ idcontent ว่าตรงกันมั้ย
        $sql_checkpost = "SELECT
                                post.ID_User 
                            FROM
                                post 
                            WHERE
                                ID_Content = '$ID_Contentedit' " ;

            $result_checkpost = $link->query($sql_checkpost);
            $row_checkpost = $result_checkpost->fetch_assoc();
            $checkpost = $row_checkpost['ID_User'];

            //ถ้า ID_User มีค่าตรงกัน    
            if($checkpost == $ID_User ){
                    //select content
                    $sql_slcontent = " SELECT
                                            content.Text_NameContent,
                                            content.Text_Content,
                                            content.Link_VDO,
                                            content.Link_Map,
                                            cate1.Name_Category AS Cate1,
                                            cate2.Name_Category AS Cate2,
                                            cate3.Name_Category AS Cate3
                                        FROM
                                        (((content INNER JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                                LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                                LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category)
                                                LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category  
                                        WHERE
                                            content.ID_Content = '$ID_Contentedit' && content.Status_Content = 'Post' " ;

                        $result_slcontent = $link->query($sql_slcontent);
                            if($result_slcontent){
                                $row_slcontent = $result_slcontent->fetch_assoc();
                                $output_slcontent[] = $row_slcontent ;
                                $j_slcontent = json_encode($output_slcontent);

                                echo $j_slcontent ;
                            } else{
                                echo "result_slcontent is false ".mysqli_error($link)."\n" ;
                            }

                    //Content edit (update)
                    $sql_ctupdate = " UPDATE content
                                        SET 
                                            Text_NameContent = '$Text_nct',
                                            Text_Content = '$Text_ct',
                                            Link_VDO = '$Link_VDO',
                                            Link_Map = '$Link_Map'
                                        WHERE content.ID_content = '$ID_Contentedit'  && content.Status_Content = 'Post' " ;
                
                        $result_ctupdate = $link->query($sql_ctupdate);

                            if($result_ctupdate){
                                echo "\nresult_ctupdate is true \n"; }
                            else{
                                echo "result_ctupdate is false ".mysqli_error($link)."\n" ;
                            }

                    //category edit (update)
                    $sql_cateupdate = " UPDATE con_in_cate
                                        SET 
                                            ID_Category1 = '$ID_Category1',
                                            ID_Category2 = '$ID_Category2',
                                            ID_Category3 = '$ID_Category3'
                                        WHERE ID_content = '$ID_Contentedit' " ;
                        
                        $result_cateupdate = $link->query($sql_cateupdate);

                            if($result_cateupdate){
                                echo "result_cateupdate is true \n"; }
                            else{
                                echo "result_cateupdate is false ".mysqli_error($link)."\n" ;
                            }

            }else{
                echo "จะไปแก้ไขบทความของผู้อื่นไม่ได้นะ ไม่ดีเลยน้าาาาา !" ;
                }
    }
    mysqli_close($link);

    ?>