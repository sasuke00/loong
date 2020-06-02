<!DOCTYPE html>
<?php
  include 'fstyle.php';
  include 'class.php';
 /* session_start();
  if(isset($_GET['logout']) AND isset($_SESSION['id'])){
    session_destroy();
    echo ' you have logged out<br>';
    session_start();
  }
  //To connect database
  @$db = new mysqli('localhost', 'root', '', 'college');
  if (mysqli_connect_errno()) {
    echo '<p>Error: Could not connect to database.<br/>
    Please try again later.</p>';
    exit;
     }
  else{
       echo'connection successful<br>';
     } 

  if(isset($_POST['button']) && $_POST['button']=='login'){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query = "SELECT * FROM `student` WHERE `email`=? AND `password`=?"; // like ?
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss',$email,$password);
    $stmt->execute();
    $stmt->store_result(); 
    $stmt->bind_result($email,$password,$name);
    $stmt->fetch();
      if($stmt->num_rows>0) {
       echo '<br>you are logged in<br>';
       $_SESSION['id']=$id;
       header('Location:hc2.php');
      } else {
        echo '<br>wrong email or password<br>';
      }
  }
  $db->close();*/
  session_start();

$pdo = new PDO('mysql:host=localhost;dbname=posting-system', 'root', '');
 $check = new Main;
 if(isset($_POST['username'],$_POST['password'])){
  @$username = $_POST['username'];
  @$password = $_POST['password'];
  
  if(empty($username) or empty($password)){
   echo "

Enter a Username and Password

";
  } else{
   
     $check->login($username,$password);
   }
  }
?>


<html>
	<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://kit.fontawesome.com/31fde02429.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="login">
			<div class="login2">
				<img src="http://www.hanchiangnews.com/hccLibrary/Logo_Full-Colour.png" width="396px" height="150px">
				<br><br><br>
				<form action="hc1.php" method="post">
					<input type="text" placeholder="Student ID" name="username">
					<br><br><br>
					<input type="password" placeholder="Password" name="password">
				<div id="mail">
          <i class="fas fa-user-circle"></i>
				</div>
				<div id="pass">
					<i class="fas fa-lock"></i>
				</div>
				<br><br>
        <input type="submit" name="button" value="login" id="btn"><br><br>
        </form>
				<h4><i>To get your account please refer to student service</i></h4>
			</div>
		</div>
	</body>
</html>