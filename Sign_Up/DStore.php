<!-- <?php

    // This script uploads the data of the user to the database and then redirects to the page 
    echo "Connection successful";

    // Connecting to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SignUpInfo";

    // Creating connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if($conn){echo "Connection Successful";}

    $sql = "USE SignUpInfo";
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE `DATA` ( `Name` VARCHAR(50) NOT NULL , `Email` VARCHAR(50)  NOT NULL PRIMARY KEY UNIQUE , `Pass` VARCHAR(50) NOT NULL , `ConPass` VARCHAR(50) NOT NULL ) ENGINE = InnoDB";
    mysqli_query($conn, $sql);
    // Now getting the data from the form 
    $name=$_POST['Name'];
    $email=$_POST["Email"];
    $pass=$_POST["Pass"];
    $conpass=$_POST["ConPass"];


    $sql="select * from DATA where (Email='$email');";

      $res=mysqli_query($conn,$sql);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if($email==isset($row['Email']))
        {
            	echo "email already exists";
                $_SESSION["status"] = "Email already taken";
                header('Location: Sign_Up.php');
        }
	
    }
    // Now storing the elements in the database 
                $sql="INSERT INTO `DATA` (`Name`, `Email`, `Pass`, `ConPass`) VALUES ('$name', '$email', '$pass', '$conpass')";
                // $sql="INSERT INTO `DATA` (`Name`, `Email`, `Pass`, `ConPass`) VALUES ('z', 'cd', 'cds', 's')";
                $result=mysqli_query($conn,$sql);
                echo $sql;
                if(!mysqli_query($conn,$sql)){echo mysqli_connect_error();}

                header('Location: ../Account_Login/Account_Login.html');
                mysqli_close($conn);

?> -->


<?php 

    $sql = "CREATE TABLE `DATA` ( `Name` VARCHAR(50) NOT NULL , `Email` VARCHAR(50)  NOT NULL PRIMARY KEY UNIQUE , `Pass` VARCHAR(50) NOT NULL , `ConPass` VARCHAR(50) NOT NULL ) ENGINE = InnoDB";
    mysqli_query($conn, $sql);   

    $username = $_POST["Name"];  
    $password = $_POST["Pass"];  
    $cpassword = $_POST["ConPass"]; 
    $email = $_POST["Email"];     

    $sql="select * from DATA where (Email='$email');";

    $res=mysqli_query($conn,$sql);

    // This sql query is use to check if 
    // the username is already present  
    // or not in our Database 
    if(mysqli_num_rows($res) == 0) { 
        if(($password == $cpassword) && $exists==false) { 

            $hash = password_hash($password,  
                                PASSWORD_DEFAULT); 
                
            // Password Hashing is used here.  
            $sql = "INSERT INTO `DATA` ( `Name`,  
                `Email`, `Pass`, `ConPass`) VALUES ('$username',  
                '$email', '$password', '$cpassword')"; 

            $result = mysqli_query($conn, $sql); 

            if ($result) { 
                $showAlert = true;  
                header('Location: ../Account_Login/Account_Login.html');
            } 
            
        }  
        else {  
            $showError = "Passwords do not match";  
        }       
    }// end if  

    if(mysqli_num_rows($res)>0)  
    { 
      $exists="Email ID exists";  
    }  

?>