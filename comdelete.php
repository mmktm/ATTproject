<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

            //comdelete
            //รับค่า ID_Comment จากตัวแปร $_POST['idcomdel'] อาจจะเป็นรูปถังขยะ
            //รับ 2 ค่า idcom and iduser
            if(isset($_POST['idcomdel']) && $_POST['idcomdel'] != '' ){ //idcomment ที่จะ delete

                $idusercomdel = $_POST['idusercomdel'];
                $idcomment = $_POST['idcomdel'] ;
                $statuscomdel = '0';
            
                $sql_comdel = " UPDATE `comment` 
                                SET Status_Comment = '$statuscomdel'
                                WHERE ID_Comment = '$idcomment' AND Status_Comment = '1' " ;
                                
                    $result_comdel = $link->query($sql_comdel);
                    // echo $result_comdel."\n";
                    echo $link->query($sql_comdel);

                    // if($result_comdel == '1' ){
                        
                    //     //ค่าidcontent
                    //     $sql_idcontent = " SELECT ID_Content
                    //                         FROM `comment` 
                    //                         WHERE ID_Comment = '$idcomment' && ID_User = '$idusercomdel' ";
                    //         $result_idcontent = $link->query($sql_idcontent);
                    //         $row_idcontent = $result_idcontent->fetch_assoc();
                    //         $idcontent = $row_idcontent['ID_Content'];

                    //     //ดึงค่าtotalcom
                    //     $sql_totalcom = " SELECT
                    //                             ID_Content,
                    //                             Total_Com 
                    //                         FROM
                    //                             content 
                    //                         WHERE
                    //                             ID_Content = '$idcontent' ";

                    //         $result_totalcom = $link->query($sql_totalcom);
                    //         $row_totalcom = $result_totalcom->fetch_assoc();
                    //         $totalcom = $row_totalcom['Total_Com'];

                    //     //ลบจำนวน totalcom in table content
                    //     $sql_deltotalcom = " UPDATE content
                    //                          SET Total_Com = '$totalcom'-1
                    //                          WHERE ID_Content = '$idcontent' ";
                    //         $result_deltotalcom = $link->query($sql_deltotalcom);

                    //         if($result_deltotalcom == '1'){
                    //             echo "result_comdelete is true \n"; }
                    //         else{
                    //             echo "result_comdelete is false ".mysqli_error($link)."\n" ;
                    //             }
           
                    // }else{
                    //     echo "error result_commdel ".mysqli_error($link)."\n" ;
                    //     }
            }

mysqli_close($link);

?>