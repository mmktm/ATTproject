<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //input id-user
    if(isset($_POST['ID_User']) && $_POST['ID_User'] != '') {
        
        $ID_User = $_POST['ID_User']; //iduser
        $Usernameedit = $_POST['Username'];
        $emailedit = $_POST['Email'];
        $passwordedit = $_POST['Passwordd'];

        $Image = $_FILES['Image']['name'];
        $ImagePath = "avatar/".$Image;
        $tmp_name = $_FILES['Image']['tmp_name'];
        
        move_uploaded_file($tmp_name,$ImagePath);

        if(isset($Usernameedit)){

            $sql_checkusername = "SELECT Username FROM `user` WHERE Username = '$Usernameedit'";
                $result_checkusername = $link->query($sql_checkusername);

                if($result_checkusername->num_rows <=0){
                    $sql_usernameedit = " UPDATE user SET Username = '$Usernameedit'
                                            WHERE ID_User = '$ID_User' && Status_User = 'active'";
                        $result_usernameedit = $link->query($sql_usernameedit);
                            if($result_usernameedit){
                                echo "change username successfully \n"; }
                            else{
                                echo "change username false ".mysqli_error($link)."\n" ;
                            }

                }else{
                    echo "$Usernameedit already exists plese try again\n";
                }
        }
        if(isset($emailedit)){

            $emailedit = filter_var($emailedit, FILTER_SANITIZE_EMAIL);
            if (!filter_var($emailedit, FILTER_VALIDATE_EMAIL) === false) {
                // echo("$Email is a valid email address\n");
                    
                $sql_checkemail = " SELECT Email FROM `user` WHERE Email = '$emailedit'" ;
    
                $result_checkemail = $link->query($sql_checkemail);
    
                if($result_checkemail->num_rows == 1 ){
                    // echo json_encode("error : username or email already exists"); 
                    echo "$emailedit already exists plese try again\n"; 
    
                }else{
                    
                    $sql_emailedit = " UPDATE user SET Email = '$emailedit'
                                        WHERE ID_User = '$ID_User' && Status_User = 'active'";
                        $result_emailedit = $link->query($sql_emailedit);
                        if($result_emailedit){
                            echo "change email successfully\n";
                        }
                }
            }else {
                echo "$emailedit is not valid email address\n";
            }
        }
        if (isset($passwordedit)){

            $sql_passwordedit = " UPDATE user SET Passwordd = '$passwordedit'
                                    WHERE ID_User = '$ID_User' && Status_User = 'active'";
                $result_passwordedit = $link->query($sql_passwordedit);
                    if($result_passwordedit){
                                echo "change password successfully \n"; 
                            }else{
                                echo "change password false".mysqli_error($link)."\n" ;
                            }
        }
        if(isset($Image)){

                $sql_imageedit = " UPDATE user SET Image = '$Image'
                                    WHERE ID_User = '$ID_User' && Status_User = 'active' " ;
                    $result_imageedit = $link->query($sql_imageedit);

                            if($result_imageedit){
                                echo "change image successfully \n"; }
                            else{
                                echo "change image false ".mysqli_error($link)."\n" ;
                            }
        }
        
    }else{
        echo "error ID_User" ; }
    
    mysqli_close($link);

    ?>