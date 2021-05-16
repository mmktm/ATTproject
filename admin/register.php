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
    <title>Register Admin</title>
    
    <style type = "text/css">
        body {
            /* background-image:url('bg.jpg') ; */
            background-color: #414448 ; 
            background-size: auto;
            font-family: "Ekkamai new" ; src :url(fonts/EkkamaiNew-Regular.ttf) ;
        }
    </style>

</head> 
<body>
    <div class="wrapper"> <!-- Register Admin -->
    <div class="boxregis"><center><div class="text1"><strong>- Register Admin -</strong></center><br>

    <form action="register_db.php" method="post">

        <?php include('errors.php'); ?> <!-- ถ้าเชื่อมไม่ได้ -->
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="error">
                    <h3>
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>

        <div class = "input-group">
            <label for="Username">Username</label>
            <input type="text" name = "Username">
        </div>
        <div class = "input-group">
            <label for="Email">Email</label>
            <input type="email" name = "Email">
        </div>
        <div class = "input-group">
            <label for="Password_1">Password</label>
            <input type="password" name = "Password_1">
        </div>
        <div class = "input-group">
            <label for="Password_2">Confirm Password</label>
            <input type="password" name = "Password_2">
        </div>
        <div class = "input-group">
        <center><button type="submit" name = "Regis_Admin" class ="sm">Register</button></center>
        </div>

        <center><p>Alredy an Admin ? <a href="login.php">Sing in</a></p></center>

    </form>
    
</body>
</html>