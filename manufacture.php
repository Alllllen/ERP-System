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
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">生產單</h2>
	<a href="index.php"><p>BETTIA -> 
	<a href="manufacture.php">生產單</p></a>
</section>
			 
<form action= "manufacture.php" method="POST">
<div class="features">
<table border="1">
						<div class="form-control">					
						<tr><td><label for="message">原料品名</label>
						 <select name="mname" required /><br>
							<?php
							 $sql="SELECT * FROM `material_stock`";
							 $result=mysqli_query($link,$sql); //執行sql指令
						     $col_total = mysqli_num_fields($result);
							 $row_total = mysqli_num_rows($result);//取得資料表資料列數
							 echo "<option value=''>-- 請選擇 --</option>"; //此行可有可無
							 for($y = 0;$y < $row_total;$y++){
								$row = mysqli_fetch_assoc($result);
								echo "<option value=".$y.">" .$row['mstock_name']. "</option>";
							}
							?>
						
						</select>

						</div></td>
						<div class="form-control">
							<td><label for="message">原料重量</label>
							<input name="mweight" id="message" type="text" required />
						</div></td>
						
						
						<div class="form-control">			
						<tr><td><label for="message">商品品名</label>
                        <select name="pname" required /><br>
							<?php
							 $sql="SELECT * FROM `product_type`";
							 $result=mysqli_query($link,$sql); //執行sql指令
						     $col_total = mysqli_num_fields($result);
							 $row_total = mysqli_num_rows($result);//取得資料表資料列數
							 echo "<option value=''>-- 請選擇 --</option>"; //此行可有可無
							 for($y = 0;$y < $row_total;$y++){
								$row = mysqli_fetch_assoc($result);
								echo "<option value=".$y.">" .$row['prod_name']. "</option>";
							}
							?>
						
						</select>

						</div></td>
						
						<div class="form-control">
						<td><label for="message">商品重量</label>
							<input name="pweight" id="message" type="text" required />
						</div>
						<div class="form-control">
							<tr><td><label for="message">測量日期</label>
							<input name="date" id="message" type="text" required />
						</div></td>
						
                        </table>
						<ul class="actions">
							<li><input value="確認" type="submit" name ="deliver"></li>
						</ul>                        
</div>
						
</form>	
<?php
if(isset($_POST['deliver']))
{
	$mname = $_POST['mname'];
	$mweight = $_POST['mweight'];
	$pname = $_POST['pname'];
	$pweight = $_POST['pweight'];
	$date = $_POST['date'];

	$sql="SELECT * FROM `material_stock`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $mname){
			$mmname = $row['mstock_num'];
			$mmmname = $row['mstock_name'];
		}
	}
	
	$sql="SELECT * FROM `product_type`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $pname){
			$pppname = $row['prod_name'];
		}
	}
	
	$sql="SELECT * FROM `product_stock` WHERE `pstock_name` = '$pppname'";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	$row = mysqli_fetch_assoc($result);
	if($row_total > 0)
		$ppname = $row['pstock_num'];
	else {
		$sql="SELECT * FROM `product_stock`";
		$result=mysqli_query($link,$sql); //執行sql指令
		$row_total = mysqli_num_rows($result);
		$ppname = $row_total;
	}
	
	$sql="SELECT * FROM `manufacture`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$num = mysqli_num_rows($result);//取得資料表資料列數
	
	$a = array ("生產編號","原料品名","原料重量","商品品名","商品重量","測量日期","確認","取消");
	echo '<form action = "manufacture.php" method ="post">';
		echo '<table border="1" style = "font-size:18px;">'; 
	    for ($y = 0;$y < 8;$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	        echo "<tr><td align='center' ><input type = 'hidden' name = 'num' value = '$num'>'$num'</font></td>";
			echo "<td align='center' ><input type = 'hidden' name = 'mname' value = '$mmname'>'$mmmname'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'mweight' value = '$mweight'>'$mweight'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'pname' value = '$ppname'>'$pppname'</td>";
			echo "<input type = 'hidden' name = 'name' value = '$pppname'>";
			echo "<td align='center' ><input type = 'hidden' name = 'pweight' value = '$pweight'>'$pweight'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'date' value = '$date'>'$date'</td>";
			echo "<td align='center'><input value='確認' type='submit' name = 'submit'></td>";
			echo "<td align='center'><input value='取消' type='submit' name = 'delete'></td>";
		echo '</table>';
	echo '</form>';
	
 
}

if(isset($_POST['submit']))
{
	$num = $_POST['num'];
	$mname = $_POST['mname'];
	$mweight = $_POST['mweight'];
	$pname = $_POST['pname'];
	$pweight = $_POST['pweight'];
	$date = $_POST['date'];
	$name = $_POST['name'];
	
	$sql="INSERT INTO `manufacture`(`manu_num`,`mat_num`,`mat_weight`,`prod_num`,`prod_weight`,`manu_date`)	
		  VALUE('$num','$mname','$mweight','$pname','$pweight','$date');";
	$result=mysqli_query($link,$sql);
	
	$sql="SELECT * FROM `material_stock` WHERE `mstock_num` = '$mname'";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row = mysqli_fetch_assoc($result);
	$weightsub = $row['mstock_weight'] - $mweight;
	
	$sql="UPDATE `material_stock` SET `mstock_weight` = '$weightsub' WHERE `mstock_num` = '$mname'";
	$result=mysqli_query($link,$sql);
	
	
	$sql="SELECT * FROM `product_stock` WHERE `pstock_num` = '$pname'";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	if($row_total> 0){
		$weightplus = $row['pstock_weight'] + $pweight;
		$sql="UPDATE `product_stock` SET `pstock_weight` = '$weightplus' WHERE `pstock_num` = '$pname'";
	}
	else{
		echo "insert";
		$sql="INSERT INTO `product_stock`(`pstock_num`,`pstock_name`,`pstock_weight`)
										VALUE('$pname','$name','$pweight');";
	}
	
	$result=mysqli_query($link,$sql);
	mysqli_close($link);
	
}
if(isset($_POST['delete']))
{
	echo '<meta http-equiv="refresh" content="0;url=manufacture.php">';
}
?>