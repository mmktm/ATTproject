<?php include('connect.php') ; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" type="text/css" href="indexstyle.css">
    <style type = "text/css">
        body {
            /* background-image:url('bg.jpg') ; */
            background-color: ;
            /* background-size: auto; */
            font-family: "Ekkamai new" ; src :url(fonts/EkkamaiNew-Regular.ttf) ;
        }
    </style>

</head>
<body>
    <div class="wrapper"> <!-- Register Admin -->
    <div class="box1"><center><div class="text1"><strong>- Register Admin -</strong></center><br>

    <form action="register.php">
        <div class = "input-group">
            <label for="Username">Username</label>
            <input type="text" name = "Username">
        </div>
        <div class = "input-group">
            <label for="Email">Email</label>
            <input type="email" name = "Email">
        </div>
        <div class = "input-group">
            <label for="Password">Password</label>
            <input type="password" name = "Password">
        </div>
        <div class = "input-group">
            <button type="submit" name = "Regis_Admin" class ="btn"></button>
        </div>

        <p>Alredy an Admin ? <a href="register.php">Sing in</a></p>
    </form>
    
</body>
</html>