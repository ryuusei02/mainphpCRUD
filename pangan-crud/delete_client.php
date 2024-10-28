<?php
session_start();

if(!isset($_SESSION[ 'username']) || $_SESSION['role'] != 'admin' )
{
    header("Location: index.php");
    exit();
}

    include('db/connection.php');

    if(isset($_GET['ID']))
    {
        $client_id = $_GET['ID'];

        //Fetch client data

        $delete_sql = " DELETE FROM users WHERE ID = '$client_id' ";
        //check if client exists

        if($conn->query($delete_sql) == TRUE)
        {
            header("Location: admin_dashboard.php?deleteresources");

        }

        else{
            echo "Error Deleting Client:".$conn->error;
        }
    }

    else{

        //No client ID redirect to dashboard
        header("Location: admin_dashboard.php");
    }

?>