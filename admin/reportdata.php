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
            url: 'rpupdate.php',
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
            if(isset($_POST["rpkeyword"])){
                $rpkeyword = $_POST["rpkeyword"];
            }
        ?>
            <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                <tr>
                <center><th>Keyword
                <input name="rpkeyword" type="text" id="rpkeyword" placeholder="Title" value="<?php echo $rpkeyword;?>">
                <input type="submit" class="box2" value="Search"></th></center>
                </tr>
            </form>

        <?php
                $sql_Report = " SELECT
                                    report.ID_User,
                                   `user`.Username,
                                    report.ID_Content,
                                    content.Title,
                                    report.Status_Report,
                                    report.Date_Report,
                                    report.Time_Report
                                FROM
                                    report
                                    JOIN `user` ON report.ID_User = `user`.ID_User
                                    JOIN content ON report.ID_Content = content.ID_Content
                                WHERE content.Title LIKE '%".$rpkeyword."%'
                                ORDER BY report.ID_Content " ;
                    
                    $result_Report = $link->query($sql_Report);   
                    if($result_Report->num_rows <=0 ){
                        echo "<center>" ."No Report this Title : '$rpkeyword'"."</center>" ;
                    } else {
                    
                        echo "<table border='1' align='center' width='80%'>";
                            //หัวข้อตาราง
                            echo "<tr align='center' bgcolor='#CCCCCC'>
                                    
                                    <th width='30%'>Title</th>
                                    
                                    <th width='10%'>Username</th>
                                    <th width='3%'>Status_Report\n1 wait to check or 0 success</th>
                                    <th width='10%'>Date_Report</th>
                                    <th width='10%'>Time_Report</th>
                                </tr>";
                                while ($row_Report = $result_Report->fetch_assoc()){

                                    $id = $row_Report['ID_Content'];
                                    $title = $row_Report['Title'];
                                    $iduser = $row_Report['ID_User'];
                                    $username = $row_Report['Username'];
                                    $statusrp = $row_Report['Status_Report'];
                                    $daterp = $row_Report['Date_Report'];
                                    $timerp = $row_Report['Time_Report'];
        ?>
                                <tr>
                                    
                                    <td><?php echo $title; ?></td>
                                    
                                    <td><?php echo $username; ?></td>
                                    <td><div contenteditable="true" 
                                             onBlur="updateValue(this,'Status_Report','<?php echo $id; ?>')" 
                                             onClick="activate(this)">
                                        <?php echo $statusrp; ?></div></td>
                                    <td><?php echo $daterp; ?></td>
                                    <td><?php echo $timerp; ?></td>
                                </tr>
                                    <!-- echo "<tr>";  
                                    echo "<td>" .$row_Report["ID_Content"]      .  "</td> ";
                                    echo "<td>" .$row_Report["Title"]           .  "</td> ";
                                    echo "<td>" .$row_Report["ID_User"]         .  "</td> "; 
                                    echo "<td>" .$row_Report["Username"]        .  "</td> ";
                                    echo "<td><div contenteditable='true' onBlur='updateValue(this,'Status_Report','$row_Report[ID_Content]')' onClick='activate(this)'>" .$row_Report["Status_Report"]   .  "</td> ";
                                    echo "<td>" .$row_Report["Date_Report"]     .  "</td> ";
                                    echo "<td>" .$row_Report["Time_Report"]     .  "</td> ";
                                    //แก้ไขข้อมูล
                                    // echo "<td><a href='UserUpdateForm.php?ID=$row[0]'>edit</a></td> ";
                                    
                                    //ลบข้อมูล
                                    // echo "<td><a href='UserDelete.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
                                    echo "</tr>"; -->
                            <?php 
                                }} //close while
                            echo "</table>";
                            mysqli_close($link); 
                            ?>
    
</body>
</html>