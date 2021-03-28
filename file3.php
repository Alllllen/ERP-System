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
<section id = "footer" style="background-color: #E8FFFF">
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">建檔(商品種類)</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="filing.php" style = "color:blue">建檔 ->
	<a href="file3.php" style = "color:blue">商品種類建檔</p></a>
</section>
			
<form action="file3.php" method="POST">
<div class="features">
						<div class="form-control">
							<label for="message" style = 'font-size:27px;'>商品名稱</label>
							<input name="name" id="message" type="text" required />
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
	$sql="INSERT INTO `product_type`(`prod_name`) VALUE('$name');";

	$result=mysqli_query($link,$sql);
}
  $a = array ("商品名稱");
  
  $sql="SELECT * FROM `product_type`";
  $result=mysqli_query($link,$sql); //執行sql指令
  $col_total = mysqli_num_fields($result);
  $row_total = mysqli_num_rows($result);//取得資料表資料列數
  echo "<br/>筆數=$row_total<br />";

  echo '<table border="1" style = "font-size:25px;">';
	 
	    for ($y = 0;$y<($col_total);$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	
  for ($y = 0;$y<($row_total);$y++){
	  echo '<form action = "file3.php" method ="post">';
    $row = mysqli_fetch_row($result);
	$nname = $row[0];
	$name = $row[0];
			echo "<tr><td align='center'><input type='text' name='name'  value ='$name'></td>";
			echo "<td align='center'><input value='修改' type='submit' name = 'revise'><input value='$nname' type='hidden' name = 'nname'></td></tr>";
			
		
	echo '</form>';
  }
echo '</table>';

if(isset($_POST['revise'])){
	
	$nname = $_POST['nname'];
	$name = $_POST['name'];
	

	$sql="UPDATE `product_type` SET `prod_name` = '$name' WHERE `prod_name` = '$nname' ";
	$result=mysqli_query($link,$sql); 
	echo '<meta http-equiv="refresh" content="0;url=file3.php">';//重整網頁
}
  mysqli_close($link);
?>