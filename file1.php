<?php
require_once 'db.php';
?>
<?php
	session_start();
	if($_SESSION["login_session"] ==  false){
		header("Location:login.php");
	}
?>
<link rel="stylesheet" href="assets/css/main.css" />
<section id = "footer" style="background-color: #E8FFFF;">
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">公司資料建檔</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="filing.php" style = "color:blue">建檔 ->
	<a href="file1.php" style = "color:blue">公司資料建檔</p></a>
</section>
			
<form action="file1.php" method="POST">
<div class="features">
						<div class="form-control" style = 'font-size:27px;'>
							<label for="message" >公司名稱</label>
							<input name="name" id="message" type="text" required />
						</div>
						<div class="form-control" style = 'font-size:27px;'>
							<label for="message">公司電話</label>
							<input name="phone" id="message" type="text" required />
						</div>	
						<div class="form-control" style = 'font-size:27px;'>
							<label for="message">公司地址</label>
							<input name="address" id="message" type="text"required />
						</div>	
						<div class="form-control" style = 'font-size:27px;'>
							<label for="message">傳真號碼</label>
							<input name="fax" id="message" type="text" required />
						</div>

						<div class="form-control" style = 'font-size:27px;'>
							<label for="message">聯絡E-MAIL</label>
							<input name="mail" id="message" type="text" required />
						</div>	
						<div class="form-control" style = 'font-size:27px;'>
							<label for="message">統一編號</label>
							<input name="taxid" id="message" type="text" required />
						</div>
						
</div>
						<ul class="actions" style="text-align:center;">
							<li><input value="確認" type="submit" name ="deliver"></li>
						</ul>
</form>	
<?php
if(isset($_POST['deliver']))
{
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$fax = $_POST['fax'];
	$mail = $_POST['mail'];
	$taxid = $_POST['taxid'];
	$sql="INSERT INTO `company`(`com_name`,`com_phone`,`com_fax`
								,`com_address`,`com_mail`,`com_taxid`)	
		  VALUE('$name','$phone','$fax','$address','$mail ','$taxid');";

	$result=mysqli_query($link,$sql);
}
  $a = array ("公司名稱","公司電話","傳真號碼","公司地址","聯絡E-MAIL","統一編號");
  
  $sql="SELECT * FROM `company`";
  $result=mysqli_query($link,$sql); //執行sql指令
  $col_total = mysqli_num_fields($result);
  $row_total = mysqli_num_rows($result);//取得資料表資料列數
  echo "<br/>筆數=$row_total;<br />";


  echo '<table border="1" style = "font-size:25px;">';
	 
	    for ($y = 0;$y<($col_total);$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	
  for ($y = 0;$y<($row_total);$y++){
	  echo '<form action = "file1.php" method ="post">';
    $row = mysqli_fetch_row($result);
	$nname = $row[0];
	$name = $row[0];
	$phone = $row[1];
	$fax = $row[2];
	$address =$row[3];
	$mail = $row[4];
	$taxid = $row[5];
			echo "<tr><td align='center'><input type='text' name='name'  value ='$name'></td>";
			echo "<td align='center'><input type='text' name='phone'  value ='$phone'></td>";
			echo "<td align='center'><input type='text' name='fax'  value ='$fax'></td>";
			echo "<td align='center'><input type='text' name='address'  value ='$address'></td>";
			echo "<td align='center'><input type='text' name='mail'  value ='$mail'></td>";
		    echo "<td align='center'><input type='text' name='taxid'  value ='$taxid'></td>";
			echo "<td align='center'><input value='修改' type='submit' name = 'revise'><input value='$nname' type='hidden' name = 'nname'></td></tr>";
			
		
	echo '</form>';
  }
echo '</table>';

if(isset($_POST['revise'])){
	
	$nname = $_POST['nname'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$fax = $_POST['fax'];
	$mail = $_POST['mail'];
	$taxid = $_POST['taxid'];
	
	$sql="UPDATE `company` SET `com_name` = '$name',`com_phone` = '$phone' ,`com_fax` = '$fax'
							 ,`com_address` = '$address' ,`com_mail` ='$mail' ,`com_taxid` = '$taxid' WHERE `com_name` = '$nname' ";
	$result=mysqli_query($link,$sql); 
	echo '<meta http-equiv="refresh" content="0;url=file1.php">';
}
  mysqli_close($link);
  
?>