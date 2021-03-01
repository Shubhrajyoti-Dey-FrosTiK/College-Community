<?php 
  // Creating a connection with the database and creating a table 
  include "DConnect.php";
?>
<?php 
    
    $showAlert = false;  
    $showError = false;  
    $exists=false; 
        
    if($_SERVER["REQUEST_METHOD"] == "POST") { 
          
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

        $sql = "CREATE TABLE `DATA` ( `Name` VARCHAR(50) NOT NULL , `Email` VARCHAR(50)  NOT NULL PRIMARY KEY UNIQUE , `Pass` VARCHAR(50) NOT NULL , `ConPass` VARCHAR(50) NOT NULL ) ENGINE = InnoDB";
        mysqli_query($conn, $sql);   
        
        $username = $_POST["Name"];  
        $password = $_POST["Pass"];  
        $cpassword = $_POST["ConPass"]; 
        $email = $_POST["Email"];     
        
        // $sql = "Select * from DATA where Email='$email'"; 
        
        // $result = mysqli_query($conn, $sql); 
        
        // $num = mysqli_num_rows($result);  

        $flag=1;

        if($username===""){$showError = "Name cannot be left empty"; $flag=0;}
        else if($email===""){$showError = "Email cannot be left empty"; $flag=0;}
        else if($password===""){$showError = "Passwords cannot be left empty"; $flag=0;}
        else if($cpassword===""){$showError = "Please confirm the password"; $flag=0;}

      if($flag===1)
      {
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
                } 
                header('Location: ../About_Me/index.html');
            }  
            else {  
                $showError = "Passwords do not match";  
            }       
        }// end if  
        
       else if(mysqli_num_rows($res)>0)  
       { 
          $exists="Email ID exists";  
       }  
        
    }//end if    
  }   
?> 
<html lang="en">
<head>

    <!-- Including the bootstrap files -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Sign UP</title>
</head>
<body>

    <!-- Checking in the form  -->
  <?php 
    
    if($showAlert) { 
    
        echo ' <div class="alert alert-success  
            alert-dismissible fade show" role="alert"> 
    
            <strong>Success!</strong> Your account is  
            now created and you can login.  
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close">  
                <span aria-hidden="true">×</span>  
            </button>  
        </div> ';  
    } 
    
    if($showError) { 
    
        echo ' <div class="alert alert-danger  
            alert-dismissible fade show" role="alert">  
        <strong>Error!</strong> '. $showError.'
    
       <button type="button" class="close" 
            data-dismiss="alert aria-label="Close"> 
            <span aria-hidden="true">×</span>  
       </button>  
     </div> ';  
   } 
        
    if($exists) { 
        echo ' <div class="alert alert-danger  
            alert-dismissible fade show" role="alert"> 
    
        <strong>Error!</strong> '. $exists.'
        <button type="button" class="close" 
            data-dismiss="alert" aria-label="Close">  
            <span aria-hidden="true">×</span>  
        </button> 
       </div> ';  
     } 
   
?> 

    <!-- Including the bootstrap files -->
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
        <div class="contents order-2 order-md-1">
    
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-7">
                <h3 class="mb-4">Sign Up</h3>
                
                <form action="Sign_Up.php" method="post">
                  <div class="form-group first">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="e.g John Smith" id="name" name="Name">
                    <!-- <p class="text-missing"><?php if(isset($errors['n'])) echo errors['n']; ?></p> -->
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="your-email@gmail.com" id="email" name="Email">
                    <!-- <p class="text-missing"><?php if(isset($errors['e'])) echo errors['e']; ?></p> -->
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Your Password" id="password" name="Pass">
                    <!-- <p class="text-missing"><?php if(isset($errors['p'])) echo errors['p']; ?></p> -->
                  </div>
                  <div class="form-group last mb-3">
                    <label for="retype-password">Re-type Password</label>
                    <input type="password" class="form-control" placeholder="Re-Type Your Password" id="retype-password" name="ConPass">
                    <!-- <p class="text-missing"><?php if(isset($errors['c'])) echo errors['c']; ?></p> -->
                  </div>
                  
                  <div class="d-flex mb-5 align-items-center">
                    <!-- <label class="control control--checkbox mb-0"><span class="caption">Creating an account means you're okay with our <a href="#">Terms and Conditions</a> and our <a href="#">Privacy Policy</a>.</span>
                      <input type="checkbox" checked="checked"/>
                      <div class="control__indicator"></div> -->
                    </label>
                  </div>
                  <div>
                        <!-- <a href="../Account_Login/Account_login.html" class="txt3"> -->
                          <!-- <h5 style="color:white" id="reg">Register</h4> -->
                          <input type="submit" class="btn btn-block btn-primary">
                        <!-- </a> -->
					          </div>
                    <div>
                          <p name="status"></p>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
</body>
</html>