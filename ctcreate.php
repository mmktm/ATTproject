<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม Post รับค่า ID_User เข้ามา
    if(isset($_POST['ID_Userpost']) && $_POST['ID_Userpost'] != '') {
        
        $Date_Content = date("Y-m-d") ;
        $Time_Content = date("H:i:s") ;
        $Status_Content = 'Post'; //status
        $ID_Userpost = $_POST['ID_Userpost']; //iduser
        $Title = $_POST['Title']; //title
        $Content = $_POST['Content'];//content
        $Link_VDO = $_POST['Link_VDO'];//link vdo
        $Location = $_POST['Location'];//link map
        $ID_Category1 = $_POST['ID_Category1']; //category1
        $ID_Category2 = $_POST['ID_Category2'];//category2
        $ID_Category3 = $_POST['ID_Category3'];//category3\

        //input image
        $Images01 = $_FILES['Images01']['name'];     
        $tmp_name01 = $_FILES['Images01']['tmp_name'];
        $ImagePath01 = 'uploadimages/'.$Images01;
        move_uploaded_file($tmp_name01,$ImagePath01);

        $Images02 = $_FILES['Images02']['name'];     
        $tmp_name02 = $_FILES['Images02']['tmp_name'];
        $ImagePath02 = 'uploadimages/'.$Images02;
        move_uploaded_file($tmp_name02,$ImagePath02);

        $Images03 = $_FILES['Images03']['name'];     
        $tmp_name03 = $_FILES['Images03']['tmp_name'];
        $ImagePath03 = 'uploadimages/'.$Images03;
        move_uploaded_file($tmp_name03,$ImagePath03);

        $Images04 = $_FILES['Images04']['name'];     
        $tmp_name04 = $_FILES['Images04']['tmp_name'];
        $ImagePath04 = 'uploadimages/'.$Images04;
        move_uploaded_file($tmp_name04,$ImagePath04);
        
        //input content
        $sql_content = " INSERT INTO content
                          (Date_Content,Time_Content,Status_Content, Title, Content, Link_VDO, Location,Images01,Images02,Images03,Images04)
                         VALUES
                          ('$Date_Content','$Time_Content','$Status_Content', '$Title', '$Content', '$Link_VDO', '$Location','$Images01','$Images02','$Images03','$Images04' ) " ;

            $result_content = $link->query($sql_content);
                if($result_content){
                    echo "result_content is true \n"; }
                else{
                    echo "result_content is false ".mysqli_error($link)."\n" ;
                }
        
        //select idcontent ที่พึ่งเพิ่ม -> insert category to con_in_cate
        $sql_idcontent = " SELECT
                                ID_Content
                            FROM
                                content
                            WHERE
                                Title = '$Title' && Status_Content = 'Post'
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

        //select date_content ->insert data to table post
        $sql_datepost = " SELECT
                            Date_Content,
                            Time_Content
                          FROM
                            content 
                          WHERE
                            ID_Content = '$idcontent' && Status_Content = 'Post' " ;

            $result_datepost = $link->query($sql_datepost);
                if($result_datepost){
                    $row_datepost = $result_datepost->fetch_assoc();
                    $datepost = $row_datepost['Date_Content'];
                    $timepost = $row_datepost['Time_Content'];
                    // echo $datepost;

                    //insert data to post
                    $sql_post = "INSERT INTO post
                                    ( ID_User, ID_Content, Status_Post, Date_Post ,Time_Post)
                                 VALUES
                                    ('$ID_Userpost','$idcontent','$Status_Content','$datepost','$timepost')" ;
                        $result_post = $link->query($sql_post);
                        // echo "\n result_post is ".json_encode($result_post);
                } else {
                    echo "result_datepost is false ".mysqli_error($link)."\n" ;
                }
    }
    mysqli_close($link);
    ?>