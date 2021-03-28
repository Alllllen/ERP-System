<?php
require_once 'db.php';
?>
<?php
	session_start();
	if($_SESSION["login_session"] ==  false){
		header("Location:login.php");
	}
?>
<link rel="stylesheet" href="assets/css/main.css"/>
<section id = "footer"  style="background-color: #E8FFFF">
	 <h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">員工資料建檔</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="filing.php" style = "color:blue">建檔 ->
	<a href="file2.php" style = "color:blue">員工資料建檔</p></a>
</section>
			
<form action="file2.php" method="POST">
<div class="features">
						<!--<div class="form-control">
							<label for="message" style = 'font-size:27px;'>員工編號</label>
							<input name="num" id="message" type="text" >
						</div>-->
						<div class="form-control">
							<label for="message" style = 'font-size:27px;'>員工名稱</label>
							<input name="name" id="message" type="text" required />
						</div>	
						<div class="form-control">
							<label for="message" style = 'font-size:27px;'>生日</label>
							<input name="birth" id="message" type="text" required />
						</div>	
						<div class="form-control">
							<label for="message" style = 'font-size:27px;'>電話</label>
							<input name="phone" id="message" type="text" required />
						</div>	
						<div class="form-control">
							<label for="message" style = 'font-size:27px;'>EMAIL</label>
							<input name="mail" id="message" type="email" required />
						</div>	
						<div class="form-control">
							<label for="message" style = 'font-size:27px;' required />住址</label>
							<input name="address" id="message" type="text">
						</div>
						<div class="form-control">
							<label for="message" style = 'font-size:27px;'>帳號</label>
							<input name="account" id="message" type="text">
						</div>
						<div class="form-control" style = 'font-size:27px;'>
							<label for="message">密碼</label>
							<input name="password" id="message" type="text">
						</div>

</div>
				<ul class="actions" style="text-align:center;">
					<li><input value="確認" type="submit" name ="deliver" onclick=”javascript:{this.disabled=true;document.form1.submit();}”></li>
				</ul>		
</form>	
<?php
if(isset($_POST['deliver']))
{
	//$num = $_POST['num'];
	$name = $_POST['name'];
	$birth = $_POST['birth'];
	$phone = $_POST['phone'];
	$mail = $_POST['mail'];
	$address = $_POST['address'];
	$account = $_POST['account'];
	$password = $_POST['password'];
	
	$sql="SELECT * FROM `employee`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	$num = $row_total;
	
	if($account == null){
		$account= $_POST['phone'];
	}
	if($password==NULL){
		$password= $_POST['phone'];
	}
	
	$sql="INSERT INTO `employee`(`emp_name`,`birth`
								,`emp_phone`,`emp_mail`,`emp_address`,`account`,`password`)	
		  VALUE('$name','$birth','$phone','$mail ','$address','$account','$password');";

	$result=mysqli_query($link,$sql);
}
  $a = array ("員工編號","員工名稱","生日","電話","EMAIL","地址","帳號","密碼");
  
  $sql="SELECT * FROM `employee`";
  $result=mysqli_query($link,$sql); //執行sql指令
  $col_total = mysqli_num_fields($result);
  $row_total = mysqli_num_rows($result);//取得資料表資料列數
  echo "<br/>筆數=$row_total<br />";


  echo '<table border="1" style = "font-size:25px;">';
	 
	    for ($y = 0;$y<($col_total);$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	
  for ($y = 0;$y<($row_total);$y++){
	  echo '<form action = "file2.php" method ="post">';
    $row = mysqli_fetch_row($result);
	$nname = $row[0];
	$num = $row[0];
	$name = $row[1];
	$birth = $row[2];
	$phone =$row[3];
	$mail = $row[4];
	$address = $row[5];
	$account = $row[6];
	$password = $row[7];
	        echo "<tr><td align='center'> $num </td>";
			echo "<td align='center'><input type='text' name='name'  value ='$name'></td>";
			echo "<td align='center'><input type='text' name='birth'  value ='$birth'></td>";
			echo "<td align='center'><input type='text' name='phone'  value ='$phone'></td>";
		    echo "<td align='center'><input type='text' name='mail'  value ='$mail'></td>";
			echo "<td align='center'><input type='text' name='address'  value ='$address'></td>";
			echo "<td align='center'><input type='text' name='account'  value ='$account'></td>";
		    echo "<td align='center'><input type='text' name='password'  value ='$password'></td>";
			echo "<td align='center'><input value='修改' type='submit' name = 'revise'>
				  <input value='$nname' type='hidden' name = 'nname'></td></tr>";
			
	echo '</form>';
  }
echo '</table>';

if(isset($_POST['revise'])){
	
	$nname = $_POST['nname'];
	$name = $_POST['name'];
	$birth = $_POST['birth'];
	$phone = $_POST['phone'];
	$mail = $_POST['mail'];
	$address = $_POST['address'];
	$account = $_POST['account'];	
	$password = $_POST['password'];
	
	$sql="UPDATE `employee` SET `emp_name`='$name',`birth`='$birth',
								`emp_phone`='$phone',`emp_mail`='$mail',`emp_address`='$address',`account`='$account',`password`='$password' WHERE `emp_num` = '$nname' ";	
		 
		 

	$result=mysqli_query($link,$sql); 
	echo '<meta http-equiv="refresh" content="0;url=file2.php">';
}
  mysqli_close($link);
?>