<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud


//code insert comment
//ต้องรับมา 3 ค่า ID_User ($_POST['idusercom']), ID_Content ($_POST['com']) and textcom = $_POST['textcom']

//กดช่อง com รับค่า ID_Content ที่ต้องการมา
if(isset($_POST['com']) && $_POST['com'] != '' ){ //รับค่าตัวแปร com และ com ต้องไม่ใช่ค่าว่าง

    $idusercom = $_POST['idusercom'] ; //iduser ที่ comment
    $idcontentcom = $_POST['com'] ; //idcontent ที่ต้องการ comment
    $textcom = $_POST['textcom'] ;
    $statuscom = '1';
    $Date_Comment = date("Y-m-d") ;
    $Time_Comment = date("H:i:s") ;

    //ดึงค่าtotalcom
    $sql_totalcom = " SELECT
                        ID_Content,
                        Total_Com 
                      FROM
                        content 
                      WHERE
                        ID_Content = '$idcontentcom' ";

                        $result_totalcom = $link->query($sql_totalcom);
                        $row_totalcom = $result_totalcom->fetch_assoc();
                        $totalcom = $row_totalcom['Total_Com'];

    $sql_com = " INSERT INTO `comment` (ID_User,ID_Content,Comment,Status_Comment,Date_Comment,Time_Comment)
                                VALUES ('$idusercom','$idcontentcom','$textcom','$statuscom','$Date_Comment','$Time_Comment')" ;
        
        $result_com = $link->query($sql_com);

    //เพิ่มจำนวน totalcom in table content
    $sql_plustotalcom = " UPDATE content
                          SET Total_Com = '$totalcom'+1
                          WHERE ID_Content = '$idcontentcom' ";
        $result_plustotalcom = $link->query($sql_plustotalcom);

        if($result_com && $result_plustotalcom){
            echo "result_com is true \n"; }
        else{
            echo "result_com is false ".mysqli_error($link)."\n" ;
            }

        }else{
            
            //comdelete
            //รับค่า ID_Comment จากตัวแปร $_POST['idcomdel'] อาจจะเป็นรูปถังขยะ
            //รับ 2 ค่า idcom and iduser
            if(isset($_POST['idcomdel']) && $_POST['idcomdel'] != '' ){ //idcomment ที่จะ delete

                $idusercomdel = $_POST['idusercomdel'];
                $idcomment = $_POST['idcomdel'] ;
                $statuscomdel = '0';
            
                $sql_comdel = " UPDATE `comment` 
                                SET Status_Comment = '$statuscomdel'
                                WHERE ID_Comment = '$idcomment' && ID_User = '$idusercomdel'" ;
                    $result_comdel = $link->query($sql_comdel);

                    if($result_comdel){
                        
                        //ค่าidcontent
                        $sql_idcontent = " SELECT ID_Content
                                            FROM `comment` 
                                            WHERE ID_Comment = '$idcomment' && ID_User = '$idusercomdel' ";
                            $result_idcontent = $link->query($sql_idcontent);
                            $row_idcontent = $result_idcontent->fetch_assoc();
                            $idcontent = $row_idcontent['ID_Content'];

                        //ดึงค่าtotalcom
                        $sql_totalcom = " SELECT
                                                ID_Content,
                                                Total_Com 
                                            FROM
                                                content 
                                            WHERE
                                                ID_Content = '$idcontent' ";

                            $result_totalcom = $link->query($sql_totalcom);
                            $row_totalcom = $result_totalcom->fetch_assoc();
                            $totalcom = $row_totalcom['Total_Com'];

                        //ลบจำนวน totalcom in table content
                        $sql_deltotalcom = " UPDATE content
                                             SET Total_Com = '$totalcom'-1
                                             WHERE ID_Content = '$idcontent' ";
                            $result_deltotalcom = $link->query($sql_deltotalcom);

                            if($result_deltotalcom){
                                echo "result_comdelete is true \n"; }
                            else{
                                echo "result_comdelete is false ".mysqli_error($link)."\n" ;
                                }
           
                    }
            }
        }

mysqli_close($link);

?>