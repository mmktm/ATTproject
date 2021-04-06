<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม Post รับค่า ID_User เข้ามา
    if(isset($_POST['content']) && $_POST['postcontent'] != '') {
        header('Content-type: application/json'); //แสดงแบบ json
        
        $ID_Userpost = $_POST['postcontent']; //iduser
        $Text_nct = $_POST['Text_nct']; //namecontent
        $Text_ct = $_POST['Text_ct'];//text
        $Link_VDO = $_POST['Link_VDO'];//link vdo
        $Link_Map = $_POST['Link_Map'];//link map
        $ID_Category1 = $_POST['ID_Category1']; //category1
        $ID_Category2 = $_POST['ID_Category2'];//category2
        $ID_Category3 = $_POST['ID_Category3'];//category3
        //images
        // echo " $ID_Userpost \n " ;

        //content update
        $sql_ctupdate = " UPDATE content
                            SET 
                                Text_NameContent = '$Text_nct',
                                Text_Content = '$Text_ct',
                                Link_VDO = '$Link_VDO',
                                Link_Map = '$Link_Map'
                         WHERE content.ID_content =  && content.Status_Content = 'Post' " ;

            $result_content = $link->query($sql_content);
            // var_dump($result_content);
                if($result_content){
                    echo "result_content is true \n"; }
                else{
                    echo "errorrrrrr ".mysqli_error($link)."\n" ;
                }

        //select idcontent ที่พึ่งเพิ่ม
        $sql_idcontent = " SELECT
                                ID_Content
                            FROM
                                content
                            WHERE
                                Text_NameContent = '$Text_nct'
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
                    echo "result_con_in_cate is ".json_encode($result_con_in_cate);
                } else {
                    echo "result_idcontent is false ".mysqli_error($link)."\n" ;
                }

        //เช็คว่าข้อมูลเข้าทั้งสองตารางแล้วใช่หรือไม่
        if($result_content && $result_con_in_cate){
            echo "\n เพิ่ม $Text_nct เรียบร้อยแล้วจ้า \n";
        } else {
            echo "\n false jaa u เขียนอะไรผิดรึเปล่า?".mysqli_error($link)."\n" ;
        }
    }
    mysqli_close($link);
