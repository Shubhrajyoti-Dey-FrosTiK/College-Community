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

		// Creating a table if there is no table
        $sql = "CREATE TABLE `DATA` ( `Name` VARCHAR(50) NOT NULL , `Email` VARCHAR(50)  NOT NULL PRIMARY KEY UNIQUE , `Pass` VARCHAR(50) NOT NULL , `ConPass` VARCHAR(50) NOT NULL ) ENGINE = InnoDB";
        mysqli_query($conn, $sql);   
         
        $password = $_POST["pass"];  
        $email = $_POST["username"];     

        $flag=1;

        if($email===""){$showError = "Email cannot be left empty"; $flag=0;}
        else if($password===""){$showError = "Passwords cannot be left empty"; $flag=0;}

      if($flag===1)
      {
			// Checking if the email is present or not
			$sql="select * from DATA where (Email='$email');";
			$res=mysqli_query($conn,$sql);
			// This sql query is use to check if 
			// the username is already present  
			// or not in our Database 
			if(mysqli_num_rows($res) > 0) { 
				$sql="select * from DATA where (Email='$email');";
				$res=mysqli_query($conn,$sql);
				$row = $res->fetch_assoc();
				if ($password!=$row['Pass']){$showError = "Email ID and password doesnot match";}
				else{header('Location: ../About_Me/index.html');}
			}// end if  
        	else{$showError = "Email ID not registered";}
    	}//end if    
  }   
?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">

    <!-- Linking all the files together -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->

    <title>MnC Webpage</title>
</head>
<body>

<?php 
    // Here we show the alerts and the warnings
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


    <!-- Inserting the bootstrap code here for the frontend -->
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-34">
						Account Login
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							User name / password?
						</a>
					</div>

					<div class="w-full text-center">
						<a href="../Sign_Up/Sign_Up.php" class="txt3">
							Sign Up
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/2.jpg');"></div>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>