<?php 
//Include database connection file
include('db/connection.php');

//Start a session variable to manage user data.
session_start();

if(isset($_POST['login']))
{
    //Sanitize the username to prevent sql injection
    $username = $conn->real_escape_string($_POST['username']);
    //Get password from the from(Not yet encrypted)
    $password = $_POST['password'];

    //SQL query to select user data from database base on the username.
    $sql_username = "SELECT * FROM users WHERE username = '$username' ";

    //Execute query
    $result = $conn ->query($sql_username);

    //Check if the query returns results.
    if($result->num_rows > 0)
    {
        //Fetch the associated user data.
        $row = $result->fetch_assoc();
        
        //Verify password against the stored has password.
        if(password_verify($password, $row['password']))
        {
            //Set session variables for username and role
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            //Redirect the user to the appropriate dashboard
            if($row['role'] == 'admin')
            {
                //Redirect to admin dashboard
                header('Location: admin_dashboard.php');

            }

            else if($row['role'] == 'client')
            {
                //Redirect to client dashboard
                header('Location: client_dashboard.php');
            }

        }

        else
        {
            //If the password is incorrect show an error message and redirect to login page
            header("Location: index.php?incorrect");
        }
    }

    else{
        //No username found
        header("Location: index.php?incorrect");
    }
    
}





?>