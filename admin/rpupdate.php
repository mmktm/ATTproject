<?php 
    include('connect.php');

    if(isset($_POST['id'])){
        $value = $_POST['value'];
        $column = $_POST['column'];
        $id = $_POST['id'];

        // echo "$value - $column - $id";
        $sql_rpupdate = "UPDATE report 
                            SET $column = '$value' 
                            WHERE ID_Content = '$id' 
                            -- LIMIT 1";

        $result_rpupdate = $link->prepare($sql_rpupdate);
        $result_rpupdate->bind_param('value',$value);
        $result_rpupdate->bind_param('id',$id);

        if($result_rpupdate->execute()){
            echo "Update Successfull";
        } else{
            echo "Failure";
        }
    }
?>