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
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">進貨登錄</h2>
	<a href="index.php"><p>BETTIA -> 
	<a href="material.php">進貨登錄</p></a>
</section>
			
<form action= "material.php" method="POST" >
<div class="features">
<table border="1">
						<div class="form-control">
							<td><label for="message">訂單編號</label>
							<input name="num" id="num" type="text" required />
						</div></td>
						
						<div class="form-control">
							<tr><td><label for="message">(訂貨日)年</label>
							<input name="ordatey" id="message" type="text" required />
						</div></td>
						<div class="form-control">
							<td><label for="message">月</label>
							<input name="ordatem" id="message" type="text" required />
						</div></td>
						<div class="form-control">
							<td><label for="message">日</label>
							<input name="ordated" id="message" type="text" required />
						</div></td>
						
						<div class="form-control">
							<tr><td><label for="message">到貨日(年)</label>
							<input name="delidatey" id="message" type="text" required />
						</div></td>
						<div class="form-control">
							<td><label for="message">月</label>
							<input name="delidatem" id="message" type="text" required />
						</div></td>
						<div class="form-control">
							<td><label for="message">日</label>
							<input name="delidated" id="message" type="text" required />
						</div></td>
						
						<div class="form-control">					
						<tr><td><label for="message">原料品名</label>
						<select name="mname" required /><br>
							<?php
							 $sql="SELECT * FROM `material_type`";
							 $result=mysqli_query($link,$sql); //執行sql指令
						     $col_total = mysqli_num_fields($result);
							 $row_total = mysqli_num_rows($result);//取得資料表資料列數
							 echo "<option value = ''>-- 請選擇 --</option>"; //此行可有可無
							for($y = 0;$y < $row_total;$y++){
								$row = mysqli_fetch_assoc($result);
								echo "<option value=".$y.">" .$row['mat_name']. "</option>";
							}
							?>
						
						</select>
							 </td></div>
				
						<div class="form-control">
						<td><label for="message">重量(KG)</label>
							<input name="weight"  type="text" required />
						</div>
						<div class="form-control">			
						<tr><td><label for="message">公司名稱</label>
                        <select name="cname" required /><br>
							<?php
							 $sql="SELECT * FROM `company`";
							 $result=mysqli_query($link,$sql); //執行sql指令
						     $col_total = mysqli_num_fields($result);
							 $row_total = mysqli_num_rows($result);//取得資料表資料列數
							 echo "<option value = ''>-- 請選擇 --</option>"; //此行可有可無
							 for($y = 0;$y < $row_total;$y++){
								$row = mysqli_fetch_assoc($result);
								echo "<option value=".$y.">" .$row['com_name']. "</option>";
							}
							?>
						
						</select>

						</div></td>
						<div class="form-control">
							<td><label for="message">單價</label>
							<input name="price" id="message" type="text" required />
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
	$num = $_POST['num'];
	$ordatey = $_POST['ordatey'];
	$ordatem = $_POST['ordatem'];
	$ordated = $_POST['ordated'];
	$delidatey = $_POST['delidatey'];
	$delidatem = $_POST['delidatem'];
	$delidated = $_POST['delidated'];
	$mname = $_POST['mname'];
	$weight = $_POST['weight'];
	$cname = $_POST['cname'];
	$price = $_POST['price'];
	
	$sql="SELECT `mat_name` FROM `material_type`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $mname)
		$mmname = $row['mat_name'];
	}
	
	$sql="SELECT `com_name` FROM `company`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $cname)
		$ccname = $row['com_name'];
	}
	
	$a = array ("訂單編號","訂貨日","到貨日","品名","重量","公司名稱","單價","總價","確認","取消");
    echo '<form action = "material.php" method ="post">';
		echo '<table border="1" style = "font-size:18px;">'; 
	    for ($y = 0;$y < 10;$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	        echo "<tr><td align='center' ><input type = 'hidden' name = 'num' value = '$num'>'$num'</font></td>";
			echo "<td align='center' ><input type = 'hidden' name = 'ordatey' value = '$ordatey'>'$ordatey / $ordatem /$ordated'</td>";
			echo "<input type = 'hidden' name = 'ordatem' value = '$ordatem'>";
			echo "<input type = 'hidden' name = 'ordated' value = '$ordated'>";
			echo "<td align='center' ><input type = 'hidden' name = 'delidatey' value = '$delidatey'>'$delidatey / $delidatem /$delidated'</td>";
			echo "<input type = 'hidden' name = 'delidatem' value = '$delidatem'>";
			echo "<input type = 'hidden' name = 'delidated' value = '$delidated'>";
			echo "<td align='center' ><input type = 'hidden' name = 'mname' value = '$mmname'>'$mmname'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'weight' value = '$weight'>'$weight'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'cname' value = '$ccname'>'$ccname'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'price' value = '$price'>'$price'</td>";
			$price = $price * $weight;
			echo "<td align='center' >'$price'</td>";
			echo "<td align='center'><input value='確認' type='submit' name = 'submit'></td>";
			echo "<td align='center'><input value='取消' type='submit' name = 'delete'></td>";
		echo '</table>';
	echo '</form>';
	

}
if(isset($_POST['submit']))
{
	$num = $_POST['num'];
	$ordatey = $_POST['ordatey'];
	$ordatem = $_POST['ordatem'];
	$ordated = $_POST['ordated'];
	$delidatey = $_POST['delidatey'];
	$delidatem = $_POST['delidatem'];
	$delidated = $_POST['delidated'];
	$mname = $_POST['mname'];
	$weight = $_POST['weight'];
	$cname = $_POST['cname'];
	$price = $_POST['price'];
	
	echo $ordatey;
	
	$sql="INSERT INTO `material_order`(`morder_num`,`morder_datey`,`morder_datem`,`morder_dated`,
	`mdeliver_datey`,`mdeliver_datem`,`mdeliver_dated`,`mat_name`,`morder_weight`,`com_name`,`morder_price`)	
		  VALUE('$num','$ordatey','$ordatem','$ordated','$delidatey','$delidatem','$delidated','$mname','$weight','$cname','$price');";
	$result=mysqli_query($link,$sql);
	
	$sql="SELECT * FROM `material_stock` WHERE `mstock_name` = '$mname'";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row = mysqli_fetch_assoc($result);
	if($row > 0){
		$weightplus = $row['mstock_weight'] + $weight;
		$sql="UPDATE `material_stock` SET `mstock_weight` = '$weightplus' WHERE `mstock_name` = '$mname'";
	}
	else{
		$sql="INSERT INTO `material_stock`(`mstock_num`,`mstock_name`,`mstock_weight`)
										VALUE('$num','$mname','$weight');";
	}
	
	$result=mysqli_query($link,$sql);
	mysqli_close($link);
}
if(isset($_POST['delete']))
{
		echo '<meta http-equiv="refresh" content="0;url=material.php">';
}
?>