<?php
//Start session
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] !='admin')
{
    header("Location: index.php");
    exit();
}

//includes connection string

include('db/connection.php');

//create a variable to store search value

$search_query = ''; //null value for now

//Check if a search query is submitted
if(isset($_GET['search'])) 
{
    $search_query = $conn -> real_escape_string($_GET['search']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLIENT DASHBOARD</title>
</head>
<body>
    <?php
    echo "Welcome Admin ".$_SESSION['username']; 
    ?>
    
    <a href="logout.php" style="float:right; text-decoration:none; color:red; " >LOGOUT</a> <br><br>

    <!-- Search Form -->

    <form action="" method="get">
        <input type="text" name="search" id="" placeholder="Search by username" value ="<?php echo $search_query?>">
        <select name="search_field" id="">
            <option value="username">username</option>
            <option value="firstname">firstname</option>
            <option value="lastname">lastname</option>
        </select> 
        <input type="submit" value="Search">
    </form>
    <br>

    <table border="1" style = "width:65%;" >
        <tr >
            <td>#</td>
            <td>Username</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Role</td>
            <td>Action</td>
        </tr>

        <?php 
        
        //modify SQL query base on the search input

        if(!empty($search_query))
        {
            $search = $_GET['search'];
            $search_field = $_GET['search_field'];
            $sql = "SELECT * FROM users WHERE role = 'client' AND $search_field LIKE '%$search%'";
        }

        else
        {
            $sql = "SELECT * FROM users WHERE role = 'client' ";
        }

        $result = $conn -> query($sql);

        //Check if any client exists
        
        if($result -> num_rows > 0)
        {
            //Loop to display each client record
            $count = 1;
            while($row = $result->fetch_assoc())
            {
                echo " <tr>";
                echo " <td > $count </td> " ;
                echo "<td>" . $row['username']. "</td>";
                echo "<td>" . $row['firstname']. "</td>";
                echo "<td>" . $row['lastname']. "</td>";
                echo "<td>" . $row['role']. "</td>";
                echo "<td>";
                echo "<a href = 'edit_client.php?ID=".$row['ID']."'>Edit  </a> |";
                echo "<a href = 'delete_client.php?ID=".$row['ID']."'onclick ='return confirm(\"Are you sure you want to delete this client?\");'>Delete</a> ";
                echo "</td>";
                echo " </tr>";

                $count++;
            }
        }
        
        else 
        {
            echo " <tr> <td colspan = '5'> NO CLIENT FOUND </td> </tr>";
        }
        ?>

    </table>
    

    <br><br><a href="create_admin.php">Create an admin account</a>
</body>
</html>