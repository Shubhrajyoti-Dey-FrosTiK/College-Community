<!-- <?php 
$servername = "localhost";
$username = "root";
$password = "";

// Creating connection
$conn = mysqli_connect($servername, $username, $password);

// Creating a database named newDB
$sql = "CREATE DATABASE SignUpInfo";
mysqli_query($conn, $sql);

// closing connection
mysqli_close($conn);
?> -->

<?php 

    // Include file which makes the 
        // Database Connection. 
        // include 'DConnect.php'; 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "SignUpInfo";

        // Creating connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // if($conn){echo "Connection Successful";}

        $sql = "USE SignUpInfo";
        mysqli_query($conn, $sql);

?>