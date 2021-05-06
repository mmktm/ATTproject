<?php 
    session_start();
    include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>User Data</title>
    
    <style type = "text/css">
        body {
            /* background-image:url('bg.jpg') ; */
            background-color: #F6F4E6 ; 
            background-size: auto;
            font-family: "Ekkamai new" ; src :url(fonts/EkkamaiNew-Regular.ttf) ;
        }
    </style>

</head> 
<body>
    <center><div class="text1"><strong>- User Data -</strong></center><br>
    <a href="index.php" ><div style='text-align:right ; color:red;' >Back</a></div>
    <?php

        $userkeyword = null;

        if(isset($_POST["userkeyword"]))
        {
            $userkeyword = $_POST["userkeyword"];
        }
        ?>
            <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                <tr>
                <center><th>Keyword
                <input name="userkeyword" type="text" id="userkeyword" placeholder="iduser,username,email,status" value="<?php echo $userkeyword;?>">
                <input type="submit" class="box2" value="Search"></th></center>
                </tr>
            </table>
            </form>

        <?php
                $sql_User = " SELECT * FROM `user` 
                                WHERE ID_User LIKE '%".$userkeyword."%' OR Username LIKE '%".$userkeyword."%' OR Email LIKE '%".$userkeyword."%' OR Status_User LIKE '%".$userkeyword."%'" ;

                $result_User = $link->query($sql_User);
                    if($result_User->num_rows <=0 ){
                        echo "No User" ;
                    } else {
                        echo "<table border='1' align='center' width='500'>";
                            //หัวข้อตาราง
                            echo "<tr align='center' bgcolor='#CCCCCC'><td>ID_User</td><td>Username</td><td>Password</td><td>Email</td><td>Images</td><td>Status_User</td><td>Date_User</td><td>Time_User</td></tr>";
                                while ($row_User = $result_User->fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td>" .$row_User["ID_User"]       .  "</td> "; 
                                    echo "<td>" .$row_User["Username"]      .  "</td> ";  
                                    echo "<td>" .$row_User["Passwordd"]     .  "</td> ";
                                    echo "<td>" .$row_User["Email"]         .  "</td> ";
                                    echo "<td>" .$row_User["Images"]        .  "</td> ";
                                    echo "<td>" .$row_User["Status_User"]   .  "</td> ";
                                    echo "<td>" .$row_User["Date_User"]     .  "</td> ";
                                    echo "<td>" .$row_User["Time_User"]     .  "</td> ";
                                    //แก้ไขข้อมูล
                                    // echo "<td><a href='UserUpdateForm.php?ID=$row[0]'>edit</a></td> ";
                                    
                                    //ลบข้อมูล
                                    // echo "<td><a href='UserDelete.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
                                    echo "</tr>";
                                }
                            echo "</table>";
                    }
                            //5. close connection
                            mysqli_close($link);
        ?>
    
</body>
</html>