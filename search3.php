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
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">目前 原料 / 商品 庫存</h2>
	<a href="index.php"><p>BETTIA -> 
	<a href="search.php">搜尋 ->
	<a href="search3.php">庫存</p></a>
</section>
			
<form action="search3.php" method="POST">
<div class="features">
					<table border="1">
						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>原料/商品</label>
							<select name="type">
								<option>-- 請選擇 --</option>
　								<option value="mat">原料</option>
　								<option value="pro">商品</option></select>
						</div></td>
						</table>
						<ul class="actions" style="text-align:center;">
							<li><input value="送出" type="submit" name ="deliver"></li>
						</ul>
												
</div>			
</form>	
<?php
if(isset($_POST['deliver']))
{
	echo '<form action = "search3.php" method ="post">';
	echo '<table border="1" style = "font-size:18px;">'; 
	$type = $_POST['type'];
	$a = array ("名稱","重量");
	for ($y = 0;$y < 2;$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	if($type=="mat"){
		$sql="SELECT * FROM `material_stock`";
		$result=mysqli_query($link,$sql); //執行sql指令
		$row_total = mysqli_num_rows($result);//取得資料表資料列數
		for($y = 0;$y < $row_total;$y++){
			$row = mysqli_fetch_assoc($result);
			$n[$y] = $row['mstock_name'];
			$w[$y] = $row['mstock_weight'];
			echo "<tr><td align='center' > $n[$y] </td>";
			echo "<td align='center' > $w[$y] KG</td>";
		
		}
	}
	if($type=="pro"){
		$sql="SELECT * FROM `product_stock`";
		$result=mysqli_query($link,$sql); //執行sql指令
		$row_total = mysqli_num_rows($result);//取得資料表資料列數
		for($y = 0;$y < $row_total;$y++){
			$row = mysqli_fetch_assoc($result);
			$n1[$y] = $row['pstock_name'];
			$w1[$y] = $row['pstock_weight'];
			echo "<tr><td align='center' > $n1[$y] </td>";
			echo "<td align='center' > $w1[$y] KG</td>";
		}
	}
	echo '</table>';
	echo '</form>';
	mysqli_close($link);
}


?>