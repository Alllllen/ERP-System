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
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">商品訂單</h2>
	<a href="index.php"><p>BETTIA -> 
	<a href="selling.php">出貨登錄</p></a>
</section>
			
<form action="selling.php" method="POST">
<div class="features">
					<table border="1">
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>訂單編號</label>
							<input name="num" type="text" required />
						</div></td>
						
						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>下單日(年)</label>
							<input name="order_dy" type="text" required />
						</div></td>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>下單日(月)</label>
							<input name="order_dm" type="text" required />
						</div></td>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>下單日(日)</label>
							<input name="order_dd" type="text" required />
						</div></td>
						
						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>預計出貨日(年)</label>
							<input name="expect_dy" type="text" required />
						</div></td>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>預計出貨日(月)</label>
							<input name="expect_dm" type="text" required />
						</div></td>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>預計出貨日(日)</label>
							<input name="expect_dd" type="text" required />
						</div></td>

						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>商品品名</label>
							<select name = "pname" required /><br>
　							<?PHP
							$sql="SELECT * FROM `product_type`"; //sql command
							$result=mysqli_query($link,$sql);
							$col_total = mysqli_num_fields($result);
							$row_total = mysqli_num_rows($result);
							echo "<option value = ''>-- 請選擇 --</option>"; //此行可有可無
							for($y=0;$y<$row_total;$y++){ //顯示資料成為select menu
								$row=mysqli_fetch_assoc($result);
								echo "<option value=".$y. ">" .$row['prod_name']. "</option>";
							}

							?>
							</select>
						</div></td>
						
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>單價</label>
							<input name="price" type="text" required />
						</div></td>
						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>公司名稱</label>
							<select name="company" required />
							<?php
							 $sql="SELECT * FROM `company`";
							 $result=mysqli_query($link,$sql); //執行sql指令
						     $col_total = mysqli_num_fields($result);
							 $row_total = mysqli_num_rows($result);//取得資料表資料列數
							echo "<option value = ''>-- 請選擇 --</option>";
							for($y = 0;$y < $row_total;$y++){
								$row = mysqli_fetch_assoc($result);
								echo "<option value=".$y.">" .$row['com_name']. "</option>";
							}
							?>
						
						</select>
						</div></td>	
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>重量</label>
							<input name="weight" type="text" required />
						</div></td>
						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>狀態</label>
							<select name="condition" required />
								<option value = ''>-- 請選擇 --</option>
　								<option value="received">已接單</option>
　								<option value="prepared">已備貨</option>
　								<option value="preparing">備貨中</option>
　								<option value="picked">已取貨</option></select>
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
	$num = $_POST['num'];
	$ordatey = $_POST['order_dy'];
	$ordatem = $_POST['order_dm'];
	$ordated = $_POST['order_dd'];
	$expect_dy= $_POST['expect_dy'];
	$expect_dm= $_POST['expect_dm'];
	$expect_dd= $_POST['expect_dd'];
	$company = $_POST['company'];
	$weight = $_POST['weight'];
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$condition = $_POST['condition'];

	$sql="SELECT `prod_name` FROM `product_type`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $pname){
			$ppname = $row['prod_name'];
		}
	}

	$sql="SELECT `com_name` FROM `company`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $company)
		$ccname = $row['com_name'];
	}
	
	$a = array ("訂單編號","訂貨日","到貨日","品名","重量","公司名稱","單價","狀態","總價","確認","取消");
	echo '<form action = "selling.php" method ="post">';
  
	echo '<table border="1" style = "font-size:18px;">'; 
	    for ($y = 0;$y < 11;$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	       echo "<tr><td align='center' ><input type = 'hidden' name = 'num' value = '$num'>'$num'</font></td>";
			echo "<td align='center' ><input type = 'hidden' name = 'order_dy' value = '$ordatey'>'$ordatey / $ordatem / $ordated '</td>";
			echo "<input type = 'hidden' name = 'order_dm' value = '$ordatem'>";
			echo "<input type = 'hidden' name = 'order_dd' value = '$ordated'>";
			echo "<td align='center' ><input type = 'hidden' name = 'expect_dy' value = '$expect_dy'>'$expect_dy / $expect_dm / $expect_dd'</td>";
			echo "<input type = 'hidden' name = 'expect_dm' value = '$expect_dm'>";
			echo "<input type = 'hidden' name = 'expect_dd' value = '$expect_dd'>";
			echo "<td align='center' ><input type = 'hidden' name = 'pname' value = '$ppname'>'$ppname'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'weight' value = '$weight'>'$weight'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'company' value = '$ccname'>'$ccname'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'price' value = '$price'>'$price'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'condition' value = '$condition'>'$condition'</td>";
			$price = $price * $weight;
			echo "<td align='center'>'$price'</td>";
			echo "<td align='center'><input value='確認' type='submit' name = 'submit'></td>";
			echo "<td align='center'><input value='取消' type='submit' name = 'delete'></td>";
	echo '</table>';
	echo '</form>';

}
if(isset($_POST['submit']))
{
	$num = $_POST['num'];
	$ordatey = $_POST['order_dy'];
	$ordatem = $_POST['order_dm'];
	$ordated = $_POST['order_dd'];
	$expect_dy= $_POST['expect_dy'];
	$expect_dm= $_POST['expect_dm'];
	$expect_dd= $_POST['expect_dd'];
	$company = $_POST['company'];
	$weight = $_POST['weight'];
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$condition = $_POST['condition'];
	
	
	$sql="INSERT INTO `product_order`(`porder_num`,`porder_datey`,`porder_datem`,`porder_dated`,
	`pdeliver_datey`,`pdeliver_datem`,`pdeliver_dated`,`prod_name`,`porder_weight`,`com_name`,`porder_price`,`porder_state`)	
		  VALUE('$num','$ordatey','$ordatem','$ordated','$expect_dy','$expect_dm','$expect_dd','$pname','$weight','$company','$price','$condition');";
	$result=mysqli_query($link,$sql);
	
	if($condition == "prepared" || $condition == "picked"){
		$sql="SELECT * FROM `product_stock` WHERE `pstock_name` = '$pname'";
		$result=mysqli_query($link,$sql); //執行sql指令
		$row = mysqli_fetch_assoc($result);
		if($row > 0){
			$weightminus = $row['pstock_weight'] - $weight;
			$sql="UPDATE `product_stock` SET `pstock_weight` = '$weightminus' WHERE `pstock_name` = '$pname'";
		}
		else{
			$weight = -$weight;
			$sql="INSERT INTO `product_stock`(`pstock_num`,`pstock_name`,`pstock_weight`)
										VALUE('$num','$pname','$weight');";
		}
	$result=mysqli_query($link,$sql);
	}
	
	mysqli_close($link);
}

if(isset($_POST['delete']))
{
	echo '<meta http-equiv="refresh" content="0;url=selling.php">';
}
?>