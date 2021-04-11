<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม Post รับค่า ID_User เข้ามา
    if(isset($_POST['ID_Userpost']) && $_POST['ID_Userpost'] != '') {
        header('Content-type: application/json'); //แสดงแบบ json
        
        $Status_Content = 'Post'; //status
        $ID_Userpost = $_POST['ID_Userpost']; //iduser
        $Text_nct = $_POST['Text_nct']; //namecontent
        $Text_ct = $_POST['Text_ct'];//text
        $Link_VDO = $_POST['Link_VDO'];//link vdo
        $Link_Map = $_POST['Link_Map'];//link map
        $ID_Category1 = $_POST['ID_Category1']; //category1
        $ID_Category2 = $_POST['ID_Category2'];//category2
        $ID_Category3 = $_POST['ID_Category3'];//category3
        //images
        // echo " $ID_Userpost \n " ;

        //input content
        $sql_content = " INSERT INTO content
                          (Status_Content, Text_NameContent, Text_Content, Link_VDO, Link_Map)
                         VALUES
                          ('$Status_Content', '$Text_nct', '$Text_ct', '$Link_VDO', '$Link_Map' ) " ;

            $result_content = $link->query($sql_content);
            // var_dump($result_content);
                if($result_content){
                    echo "result_content is true \n"; }
                else{
                    echo "result_content is false ".mysqli_error($link)."\n" ;
                }
        
        //insert category to con_in_cate
        //select idcontent ที่พึ่งเพิ่ม
        $sql_idcontent = " SELECT
                                ID_Content
                            FROM
                                content
                            WHERE
                                Text_NameContent = '$Text_nct' && Status_Content = 'Post'
                                -- Text_NameContent = 'เที่ยวแดนเหนือ'
                            ORDER BY
                                ID_Content DESC 
                                LIMIT 1" ;

            $result_idcontent = $link->query($sql_idcontent);
                if($result_idcontent){
                    $row_idcontent = $result_idcontent->fetch_assoc();//assocเลือกค่าเดียว
                    $idcontent = $row_idcontent['ID_Content'] ;//ค่า idcontent ที่ select ได้
                    // var_dump($idcontent);
                    // echo $idcontent ;

                        //insert category to con_in_cate
                        $sql_con_in_cate = " INSERT INTO con_in_cate
                                                (ID_Content , ID_Category1 , ID_Category2 , ID_Category3 )
                                            VALUES
                                                ('$idcontent' , '$ID_Category1', '$ID_Category2', '$ID_Category3') "; 
                    #echo $sql_con_in_cate;
                    $result_con_in_cate = $link->query($sql_con_in_cate);
                    // echo "result_con_in_cate is ".json_encode($result_con_in_cate);
                } else {
                    echo "result_idcontent is false ".mysqli_error($link)."\n" ;
                }

        //insert data to table post
        //select date_content
        $sql_datepost = " SELECT
                            Date_Content 
                          FROM
                            content 
                          WHERE
                            ID_Content = '$idcontent' && Status_Content = 'Post' " ;

            $result_datepost = $link->query($sql_datepost);
                if($result_datepost){
                    $row_datepost = $result_datepost->fetch_assoc();
                    $datepost = $row_datepost['Date_Content'];
                    // echo $datepost;

                    //insert data to post
                    $sql_post = "INSERT INTO post
                                    ( ID_User, ID_Content, Status_Post, Date_Post )
                                 VALUES
                                    ('$ID_Userpost','$idcontent','$Status_Content','$datepost')" ;
                        $result_post = $link->query($sql_post);
                        // echo "\n result_post is ".json_encode($result_post);
                } else {
                    echo "result_datepost is false ".mysqli_error($link)."\n" ;
                }
    }
    mysqli_close($link);
    ?>