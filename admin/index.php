<?php 
    session_start();
    
    if(!isset($_SESSION['Username'])){
        $_SESSION['msg'] = "You must login first";
        header('location: login.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['Username']);
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin</title>
    
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
        <!-- logged in user information -->
        <?php if(isset($_SESSION['Username'])) : ?>

            <a href="index.php?logout='1'" ><div style='text-align:right ; color:red;' >Logout</a></div>
            <p>Welcome Admin : <strong><?php echo $_SESSION['Username']; ?></strong></p>
            
        <?php endif ?>

        <center><div class = "input-group">
        <a href="reportdata.php" ><div class="sm">Report</a></div>
        <a href="userdata.php" ><div class="sm">User</a></div>
        <a href="contentdata.php" ><div class="sm">Content</a></div>
   
        </div></center>

</body>
</html>