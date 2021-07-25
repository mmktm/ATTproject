<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//show status fav

    //input iduser and idcontent 
    if(isset($_GET['iduser']) && $_GET['iduser'] != '') {
        
        $iduser = $_GET['iduser']; //iduser
        $idcontent = $_GET['idcontent']; //idcontent
        
                    //Statuscontent edit (update)
                    $sql_statusct = " UPDATE content SET Status_Content = '$statusct' WHERE ID_Content = '$ID_Content' && Status_Content = 'posted'" ;
                
                        $result_statusct = $link->query($sql_statusct);

                            if($result_statusct){
                                echo "posted->hidden is success \n"; }
                            else{
                                echo "posted->hidden is false ".mysqli_error($link)."\n" ;
                            }
            }else{echo "error idcontent" ; }
    
    mysqli_close($link);

    ?>