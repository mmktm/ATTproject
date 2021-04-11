<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connectlc.php'; //เชื่อมต่อDATABASE cloud
    
    //ต้องรับมา 2 ค่า id-user and id-content
    //กดปุ่ม delete รับค่า ID_Content ที่ต้องการ delete 
    if(isset($_POST['ID_Contentdl']) && $_POST['ID_Contentdl'] != ''){
        header('Content-type: application/json'); //แสดงแบบ json

        $ID_User = $_POST['ID_User']; //iduser
        $ID_Contentdl = $_POST['ID_Contentdl']; //idcontent


        //check iduser กับ idcontent ว่าตรงกันมั้ย
        $sql_checkpost = " SELECT
                                post.ID_User 
                            FROM
                                post 
                            WHERE
                                ID_Content = '$ID_Contentdl' " ;

            $result_checkpost = $link->query($sql_checkpost);
            $row_checkpost = $result_checkpost->fetch_assoc();
            $checkpost = $row_checkpost['ID_User'];

             //ถ้า ID_User มีค่าตรงกัน 
            if($checkpost == $ID_User ){
                //update Status_Post 
                $sql_ctdelete = " UPDATE post 
                                    SET Status_Post = 'Delete' 
                                    WHERE
                                        ID_Content = '$ID_Contentdl' " ;

                    $result_ctdelete = $link->query($sql_ctdelete);
                        if($result_ctdelete){
                            echo "result_ctdelete is true \n"; }
                        else{
                            echo "result_ctdelete is false ".mysqli_error($link)."\n" ;
                        }
            }else{
                echo "จะไปลบบทความของผู้อื่นไม่ได้นะ" ;
            }
}
    mysqli_close($link);

?>