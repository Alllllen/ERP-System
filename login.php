<?php
require_once 'db.php';
?>

<!-- Two --> 
		<link rel="stylesheet" href="assets/css/main.css" />
		
			<section id="two" class="wrapper style2 special">
				<div class="inner narrow">
					<header>
						<h2>登入</h2>
					</header>
					<form class="grid-form" method="post" action="login.php">
						<div class="form-control">
							<label for="email">帳號</label>
							<input type="text" name ="account" placeholder = "輸入帳號" required />
						</div>
						<div class="form-control">
							<label for="message">密碼</label>
							<input type="text" name="password" placeholder = "輸入密碼" required />
						</div>
						<ul class="actions">
							<li><input value="確認" type="submit" name="deliver"></li>
						</ul>
					</form>
				</div>
			</section>
			
<?php
session_start();

if(isset($_POST['deliver']))
{
	$password = $_POST['password'];
	$account = $_POST['account'];
	
	$sql="SELECT * FROM `employee` WHERE `account` = '$account'";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row = mysqli_fetch_assoc($result);
	
	if($row['password'] == $password){
		$_SESSION["name_session"] = $row['emp_name'];   
		$_SESSION["login_session"] = true;	
		header("Location:index.php"); 
	}
	else{
		 echo "<script>";
		 echo "alert('Wrong password or account')";
		 echo "</script>";
	}
}

?>