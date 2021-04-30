<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud
    
    //ต้องรับมา 2 ค่า id-user and id-content
    //กดปุ่ม delete รับค่า ID_Content ที่ต้องการ delete 
    if(isset($_POST['ID_Contentdl']) && $_POST['ID_Contentdl'] != ''){

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
                //update Status_Post in post table
                $sql_updatestp = " UPDATE post 
                                    SET Status_Post = 'Delete' 
                                    WHERE
                                        ID_Content = '$ID_Contentdl' " ;

                    $result_updatestp = $link->query($sql_updatestp);
                        if($result_updatestp){
                            echo "result_updatestp is true \n"; }
                        else{
                            echo "result_updatestp is false ".mysqli_error($link)."\n" ;
                        }
                
                //update Status_Post in content table
                $sql_updatestct =  " UPDATE content 
                                        SET Status_Content = 'Delete' 
                                        WHERE
                                            ID_Content = '$ID_Contentdl' " ;

                    $result_updatestct = $link->query($sql_updatestct);
                        if($result_updatestct){
                            echo "result_updatestct is true \n"; }
                        else{
                            echo "result_updatestct is false ".mysqli_error($link)."\n" ;
                        }

            }else{
                echo "จะไปลบบทความของผู้อื่นไม่ได้นะ" ;
            }
}
    mysqli_close($link);

?>