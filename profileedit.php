<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //input id-user
    if(isset($_POST['ID_User']) && $_POST['ID_User'] != '') {
        
        $ID_User = $_POST['ID_User']; //iduser
        $Username = $_POST['Username'];

        $Image = $_FILES['Image']['name'];
        $ImagePath = "avatar/".$Image; 
        $tmp_name = $_FILES['Image']['tmp_name'];
        
        move_uploaded_file($tmp_name,$ImagePath);
        
                    //Profile edit (update)
                    $sql_pfedit = " UPDATE user
                                        SET 
                                            Username = '$Username',
                                            Image = '$Image'
                                        WHERE
                                            ID_User = '$ID_User' && Status_User = 'Active' " ;
                
                        $result_pfedit = $link->query($sql_pfedit);

                            if($result_pfedit){
                                echo "result_pfedit is true \n"; }
                            else{
                                echo "result_pfedit is false (Status-user) ".mysqli_error($link)."\n" ;
                            }
            }else{echo "error if" ; }
    
    mysqli_close($link);

    ?>