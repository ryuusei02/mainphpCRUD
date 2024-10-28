<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <span style = "color:red">
        <?php
        if(isset($_GET['message']))
        {
            echo $_GET['message'];
        }
        ?>
    </span>
    <h1>Registration Form </h1>

    <form action="admin_account.php" method="post">
        <input type="text" name="firstname" id=" " placeholder= "Enter First Name" required>
        <br><br>
        <input type="text" name="lastname" id=" " placeholder= "Enter Last Name" required>
        <br><br>
        <input type="text" name="username" id=" " placeholder= "Enter Username" required>
        <br><br>
        <input type="password" name="password" id=" " placeholder= "Enter Password" required>
        <br><br>
        <input type="submit" value="Register" name ="register";>
    </form>

    <a href="index.php">Already have an account?</a>
</body>
</html>