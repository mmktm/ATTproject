<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type:application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    $Email = $_POST['Email'];
    $Passwordd = $_POST['Passwordd'];	
    // $Email = $_POST['Email'];

    $sql_checklogin = " SELECT * FROM `user` 
                        WHERE Email = '$Email' AND Passwordd = '$Passwordd'" ;
        
        $result_checklogin = $link->query($sql_checklogin);

            if($result_checklogin->num_rows == 1 ){
                echo json_encode("Login Success"); 
                while ($row_checklogin = $result_checklogin->fetch_assoc()){
                    $output_checklogin[] = $row_checklogin ;
                    $j_checklogin = json_encode($output_checklogin);
                }
                echo "$j_checklogin\n" ;

            }else{
                echo json_encode("error");
            }

mysqli_close($link);

?>