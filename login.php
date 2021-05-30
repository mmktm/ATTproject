<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type:application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    $Email = $_POST['Email'];
    $Passwordd = $_POST['Passwordd'];

    $userdata = array();
    

    $sql_checklogin = " SELECT * FROM `user` 
                        WHERE Email = '$Email' AND Passwordd = '$Passwordd'" ;
        
        $result_checklogin = $link->query($sql_checklogin);
        $userdata = $result_checklogin->fetch_assoc();

            if($userdate->num_rows == 1 ){

                // $sql = "SELECT * FROM `user` 
                //         WHERE Email = '$Email'";
                // $result = $link->query($sql);
                // $userdata = mysqli_fetch_array($result);

                // echo json_encode("Success");
                echo json_encode($userdata,JSON_NUMERIC_CHECK);
                // echo json_encode($userdata);



                // while ($row_checklogin = $result_checklogin->fetch_assoc()){
                //     $output_checklogin[] = $row_checklogin ;
                //     $j_checklogin = json_encode($output_checklogin);
                // }
                // echo "$j_checklogin\n" ;

            }else{
                echo json_encode("error");
                // echo "error ".mysqli_error($link)."\n" ;
            }

mysqli_close($link);

?>