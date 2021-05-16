<?php 
    include('connect.php');

    if(isset($_POST['id'])){
        $value = $_POST["value"];
        $column = $_POST['column'];
        $id = $_POST['id'];

        // echo "$value - $column - $id";
        $sql_userupdate = "UPDATE user
                            SET $column = '$value' 
                            WHERE ID_User = '$id' 
                            -- LIMIT 1";
        $result_userupdate = $link->query($sql_userupdate);
        // $result_userupdate = $link->prepare($sql_userupdate);
        // $result_userupdate->bind_param('value',$value);
        // $result_userupdate->bind_param('id',$id);

        // if($result_userupdate->execute()){
        //     echo "Update Successfull";
        // } else{
        //     echo "Failure";
        // }
    }
?>