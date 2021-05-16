<?php 
    session_start();
    include('connect.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function activate(element){
        // alert('clicked') //แจ้งเตือนการกด
    }
    function updateValue(element,column,id){
        var value = element.innerText
        
        $.ajax({
            url: 'userupdate.php',
            type: 'post',
            data: {
                value: value,
                column: column,
                id: id
            },
            success:function(php_result){
                console.log(php_result);
            }
        })
    }
</script>

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
                if(isset($_POST["userkeyword"])){
                    $userkeyword = $_POST["userkeyword"];
                }
        ?>
            <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                <tr>
                <center><th>Keyword
                <input name="userkeyword" type="text" id="userkeyword" placeholder="iduser,username,email,status" value="<?php echo $userkeyword;?>">
                <input type="submit" class="box2" value="Search"></th></center>
                </tr>
            </form>

        <?php
                $sql_User = " SELECT * FROM `user` 
                                WHERE ID_User LIKE '%".$userkeyword."%' 
                                OR Username LIKE '%".$userkeyword."%' 
                                OR Email LIKE '%".$userkeyword."%' 
                                OR Status_User LIKE '%".$userkeyword."%'" ;

                $result_User = $link->query($sql_User);
                if($result_User->num_rows <=0 ){
                    echo "<center>" ."No Answer this '$userkeyword'"."</center>" ;
                } else {

                        echo "<table border='1' align='center' width='80%'>";
                            //หัวข้อตาราง
                            echo "<tr align='center' bgcolor='#CCCCCC'>
                                    <th width='5%'>ID_User</th>
                                    <th width='20%'>Username</th>
                                    <th width='12%'>Password</th>
                                    <th width='20%'>Email</th>
                                    <th width='10%'>Image</th>
                                    <th width='12%'>Date_User</th>
                                    <th width='10%'>Time_User</th>
                                    <th width='12%'>Status_User\nActive or Block</th>
                                    
                                </tr>";
                                while ($row_User = $result_User->fetch_assoc()){

                                    $id = $row_User['ID_User'];
                                    $username = $row_User['Username'];
                                    $pw = $row_User['Passwordd'];
                                    $email = $row_User['Email'];
                                    $img = $row_User['Image'];
                                    $statususer = $row_User['Status_User'];
                                    $dateuser = $row_User['Date_User'];
                                    $timeuser= $row_User['Time_User'];

        ?>                            
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $pw; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $img; ?></td>
                                    <td><?php echo $dateuser; ?></td>
                                    <td><?php echo $timeuser; ?></td>
                                    <td><div contenteditable="true" onBlur="updateValue(this,'Status_User','<?php echo $id; ?>')" onClick="activate(this)">
                                        <?php echo $statususer; ?></div></td>
                                    
                                </tr>

                                <?php 
                                }}
                                echo "</table>";
                                mysqli_close($link);
                                ?>
                                    <!-- // echo "<tr>";
                                    // echo "<td>" .$row_User["ID_User"]       .  "</td> "; 
                                    // echo "<td>" .$row_User["Username"]      .  "</td> ";  
                                    // echo "<td>" .$row_User["Passwordd"]     .  "</td> ";
                                    // echo "<td>" .$row_User["Email"]         .  "</td> ";
                                    // echo "<td>" .$row_User["Image"]        .  "</td> ";
                                    // echo "<td>" .$row_User["Status_User"]   .  "</td> ";
                                    // echo "<td>" .$row_User["Date_User"]     .  "</td> ";
                                    // echo "<td>" .$row_User["Time_User"]     .  "</td> ";
                                    //แก้ไขข้อมูล
                                    // echo "<td><a href='UserUpdateForm.php?ID=$row[0]'>edit</a></td> ";
                                    
                                    //ลบข้อมูล
                                    // echo "<td><a href='UserDelete.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
                    //                 echo "</tr>";
                    //             }
                    //         echo "</table>";
                    // }
                            //5. close connection
                            // mysqli_close($link);
        ?> -->
</body>
</html>