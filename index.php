<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php //Code for Sign-up

if(isset($_GET['sign-up']))
{  
	?>
	<div style="text-align:center; color:white;font-size:20px;width: 500px;;background:green;border: 2px solid #ccc;border-radius: 15px">Online Hotel Mangement System</div>

	<form action="" method="post">
         
	      <label>Phone No.</label>
	      <input type="number" name="phone" placeholder="Phone No."><br>

	     <label>User Name</label>
     	 <input type="text" name="uname" placeholder="User Name"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password"><br>
		
     
		<label>Retype Password</label>
     	<input type="password" name="retype" placeholder=" Retype Password"><br>

     	<button type="submit" name="register_btn">Register</button>
		 </form>


<?php //Code for Sign-in

}
else
{
?>
     
     <div style="text-align:center; color:white;font-size:20px;width: 500px;background:green;border: 2px solid #ccc;border-radius: 15px">Online Hotel Mangement System</div>
	 <form action="login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>User Name</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>User Name</label>
     	<input type="password" name="password" placeholder="Password"><br>

     	<button type="submit" name="login_btn">Login</button>

		 <!-- <div class="">
					<div class="">
						Don't have an account? <a href="?sign-up=1" class=">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#" class="text-white">Forgot your password?</a>
					</div>
				</div> -->
				<button type="submit" name="register_btn" >Sign Up</button>
            <!-- <br>Don't have an account? <a href="" class=""> Sign Up</a> -->
			<br><a href="" class="">Forgot Your Password?</a>
			


         </form>
<?php

}




if(isset($_POST['register_btn']))

{
	
require_once("db_conn.php");



$password = $_POST['password']; // plain password
$username=$_POST['uname'];
$phone=$_POST['phone'];
$retype=$_POST['retype'];


if($u_password == $u_retype)
	{
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		

		$stmt=$conn->prepare("INSERT INTO `users` ( `username`, `password`, `phone`) VALUES ( :username,:password,:phone)");
    
	  // Encrypted password
	  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam("username", $username);
        $stmt->bindParam("password", $hashedPassword);
        $stmt->bindParam("phone",$phone);

        $stmt->execute();
		
				?>
		<script> location.assign("?sign-up=1&registered=1");</script>

   <?php
	}

	 
	
	else
	{
		?>
	<script> location.assign("?sign-up=1&invalid=1");</script>
		
  <?php
	}
}



else if(isset($_POST['login_btn']))
{
if (isset($_POST['uname']) && isset($_POST['password']))
 {

	function validate($data)
	{
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) 
	{
		header("Location: index.php?error=User Name is required");
	    exit();
	}
	else if(empty($pass))
	{
        header("Location: index.php?error=Password is required");
	    exit();
	}

   else
   {
		$sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) 
		{
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) 
			{
            	$_SESSION['username'] = $row['username'];
            	
            	$_SESSION['id'] = $row['id'];
            	header("Location: Dashboard.php");
		        exit();
            }
			else
			{
				header("Location: index.php?error=Incorect User name or password");
		        exit();
			}
		}
		else
		{
			header("Location: index.php?error=Incorect User name or password");
	        exit();
		}
	}

   }
 else
   {
	
	header("Location: index.php");
	exit();
	
  }
}
?>

