<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //input id-user
    if(isset($_POST['ID_User']) && $_POST['ID_User'] != '') {
        
        $ID_User = $_POST['ID_User']; //iduser
        
        //กดปุ่ม Block เข้ามา
        if(isset($_POST['Block'])){

            //update status user Active -> Block
            $sql_blockuser = "UPDATE `user` SET Status_User = 'Block' WHERE ID_User = '$ID_User'";
                $result_blockuser = $link->query($sql_blockuser);

                if($result_blockuser){
                    echo "result_blockuser is true \n"; }
                else{
                    echo "result_blockuser is false ".mysqli_error($link)."\n" ;
                }

        }else if(isset($_POST['Active'])){
            
            //กดปุ่ม Active เข้ามา
            // if(isset($_POST['Active'])){
                
                //update status user Block -> Active
                $sql_activeuser = "UPDATE `user` SET Status_User = 'Active' WHERE ID_User = '$ID_User'";
                    $result_activeuser = $link->query($sql_activeuser);

                if($result_activeuser){
                    echo "result_activeuser is true \n"; }
                else{
                    echo "result_activeuser is false ".mysqli_error($link)."\n" ;
                }
            }
        
        }else{
            echo "error if" ; }
    
    mysqli_close($link);

    ?>