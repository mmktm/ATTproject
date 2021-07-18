<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //input id-content
    if(isset($_POST['ID_Content']) && $_POST['ID_Content'] != '') {
        
        $ID_Content = $_POST['ID_Content']; //idcontent
        $statusct = 'Hidden';
        
                    //Statuscontent edit (update)
                    $sql_statusct = " UPDATE content SET Status_Content = '$statusct' WHERE ID_Content = '$ID_Content'" ;
                
                        $result_statusct = $link->query($sql_statusct);

                            if($result_statusct){
                                echo "result_statusct is true \n"; }
                            else{
                                echo "result_statusct is false ".mysqli_error($link)."\n" ;
                            }
            }else{echo "error if" ; }
    
    mysqli_close($link);

    ?>