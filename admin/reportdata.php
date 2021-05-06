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
    <title>Report Data</title>
    
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
    <center><div class="text1"><strong>- Report -</strong></center><br>
    <a href="index.php" ><div style='text-align:right ; color:red;' >Back</a></div>
        <?php

        $rpkeyword = null;

        if(isset($_POST["rpkeyword"]))
        {
            $rpkeyword = $_POST["rpkeyword"];
        }
        ?>
            <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                <tr>
                <center><th>Keyword
                <input name="rpkeyword" type="text" id="rpkeyword" placeholder="Title" value="<?php echo $rpkeyword;?>">
                <input type="submit" class="box2" value="Search"></th></center>
                </tr>
            </table>
            </form>

        <?php
                $sql_Report = " SELECT
                                    report.ID_User,
                                   `user`.Username,
                                    report.ID_Content,
                                    content.Title,
                                    report.Status_Report,
                                    report.Date_Report 
                                FROM
                                    report
                                    JOIN `user` ON report.ID_User = `user`.ID_User
                                    JOIN content ON report.ID_Content = content.ID_Content
                                WHERE content.Title LIKE '%".$rpkeyword."%'
                                ORDER BY report.ID_Content " ;
                    
                    $result_Report = $link->query($sql_Report);   
                    
                    
                        echo "<table border='1' align='center' width='500'>";
                            //หัวข้อตาราง
                            echo "<tr align='center' bgcolor='#CCCCCC'><td>ID_Content</td><td>Title</td><td>ID_User</td><td>Username</td><td>Status_Report</td><td>Date_Report</td></tr>";
                                while ($row_Report = $result_Report->fetch_assoc()){
                                    echo "<tr>";  
                                    echo "<td>" .$row_Report["ID_Content"]      .  "</td> ";
                                    echo "<td>" .$row_Report["Title"]           .  "</td> ";
                                    echo "<td>" .$row_Report["ID_User"]         .  "</td> "; 
                                    echo "<td>" .$row_Report["Username"]        .  "</td> ";
                                    echo "<td>" .$row_Report["Status_Report"]   .  "</td> ";
                                    echo "<td>" .$row_Report["Date_Report"]     .  "</td> ";
                                    //แก้ไขข้อมูล
                                    // echo "<td><a href='UserUpdateForm.php?ID=$row[0]'>edit</a></td> ";
                                    
                                    //ลบข้อมูล
                                    // echo "<td><a href='UserDelete.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
                                    echo "</tr>";
                                }
                            echo "</table>";
                            //5. close connection
                            mysqli_close($link);
        ?>
    
</body>
</html>