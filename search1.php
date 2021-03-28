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
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">交易紀錄</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="search.php" style = "color:blue">搜尋 -></a>
	<a href="search1.php" style = "color:blue">交易紀錄</p></a>
</section>
<form action="search1.php" nam= "form1" method="POST">
<div class="features">

<table border="1">
							<div class="form-control">					
							<td><label for="message" style = 'font-size:27px;'>原料品名</label>
							<select name="mname"><br>
							<?php
							
							 $sql="SELECT * FROM `material_type`";
							 $result=mysqli_query($link,$sql); //執行sql指令
						     $col_total = mysqli_num_fields($result);
							 $row_total = mysqli_num_rows($result);//取得資料表資料列數
							 echo "<option value = 'x'>-- 請選擇 --</option>"; //此行可有可無
							 for($y = 0;$y < $row_total;$y++){
								$row = mysqli_fetch_assoc($result);
								echo "<option value=".$y.">" .$row['mat_name']. "</option>";
							}
							?>
							</select>
							<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>商品品名</label>
							<select name = "pname" ><br>
　							<?PHP
							$sql="SELECT * FROM `product_type`"; //sql command
							$result=mysqli_query($link,$sql);
							$col_total = mysqli_num_fields($result);
							$row_total = mysqli_num_rows($result);
							echo "<option value = 'x'>-- 請選擇 --</option>"; //此行可有可無
							for($y=0;$y<$row_total;$y++){ //顯示資料成為select menu
								$row=mysqli_fetch_assoc($result);
								echo "<option value = ".$y. ">" .$row['prod_name']. "</option>";
							}

							?>
							</select>
						</div></td>
							</select>
							</td></div>
							
							<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>年份</label>
							<select name="year" >
								<?php
						
								echo "<option value = 'x'>-- 全部 --</option>";
								echo $taiwan_date = date('Y')-1911;
								for($y = 0;$y < 5;$y++){
									$taiwan_date = (date('Y')-$y)-1911;
									echo "<option value=".$taiwan_date.">" .$taiwan_date. "</option>";
									}
								?>
							</select></td></div>
						
							<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>月份</label>
							<select name="date">
								<option value='x'>-- 全部 --</option>
　								<option value="01">1月</option>
　								<option value="02">2月</option>
								<option value="03">3月</option>
　								<option value="04">4月</option>
								<option value="05">5月</option>
　								<option value="06">6月</option>
								<option value="07">7月</option>
　								<option value="08">8月</option>
								<option value="09">9月</option>
　								<option value="10">10月</option>
　								<option value="11">11月</option>
　								<option value="12">12月</option>
							</select>
							</td></div>
						
							
							<div class="form-control">			
							<td><label for="message" style = 'font-size:27px;'>公司名稱</label>
							<select name="cname">
								<?php
								$sql="SELECT * FROM `company`";
								$result=mysqli_query($link,$sql); //執行sql指令
								$col_total = mysqli_num_fields($result);
								$row_total = mysqli_num_rows($result);//取得資料表資料列數
								echo "<option value = 'x'>-- 全部 --</option>"; //此行可有可無
								for($y = 0;$y < $row_total;$y++){
								$row = mysqli_fetch_assoc($result);
								echo "<option value=".$y.">" .$row['com_name']. "</option>";
								}
								?>
							</select>
							</div></td>
						
</table>
				<ul class="actions" style="text-align:center;">
							<li><input value="確認" type="submit" name ="deliver"  onClick="check()"></li>
				</ul>	
</div>	
</form>	

<?php
if(isset($_POST['deliver']))
{
	$mname = $_POST['mname'];
	$pname = $_POST['pname'];
	$cname = $_POST['cname'];
	$year = $_POST['year'];
	$date = $_POST['date'];
	
	$sql="SELECT `com_name` FROM `company`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $cname)
		$ccname = $row['com_name'];
	}
	
	$sql="SELECT `mat_name` FROM `material_type`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $mname)
		$mmname = $row['mat_name'];
	}
	
	$sql="SELECT `prod_name` FROM `product_type`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $pname){
			$ppname = $row['prod_name'];
		}
	}
	
	$m = array ("訂單編號","重量","訂貨日","到貨日","單價","公司名稱","品名","總價");
	$p = array ("訂單編號","重量","到貨日","訂貨日","狀態","品名","公司名稱","單價","總價");
	$pro = 0;
	$mat = 0;
	if($mname != 'x'){
		$arr = "SELECT * FROM `material_order` WHERE `mat_name` = '$mmname'";
		if($year != 'x'){
			$arr = $arr." AND `morder_datey` = '$year'";
		}
		if($date != 'x'){
			$arr = $arr." AND `morder_datem` = '$date'";
		}
	}
	else if($pname != 'x'){
		$arr = "SELECT * FROM `product_order` WHERE `prod_name` = '$ppname'";
		if($year != 'x'){
			$arr = $arr." AND `porder_datey` = '$year'";
		}
		if($date != 'x'){
			$arr = $arr." AND `porder_datem` = '$date'";
		}
	}
	else if($pname == 'x' && $mname == 'x'){
		$sql = "SELECT * FROM `material_order` WHERE `com_name` = '$ccname'";
		$result=mysqli_query($link,$sql); //執行sql指令
		$row_total = mysqli_num_rows($result);//取得資料表資料列數
		if($row_total > 0)
			$mat = 1;
				
		$sql = "SELECT * FROM `product_order` WHERE `com_name` = '$ccname'";
		$result=mysqli_query($link,$sql); //執行sql指令
		$row_total = mysqli_num_rows($result);//取得資料表資料列數
		if($row_total > 0)
			$pro = 1;
	}
	else{
		 echo "<script>";
		 echo "alert('錯誤格式')";
		 echo "</script>";
	}
	
	if($mat != 1 && $pro != 1){
		if($cname != 'x'){
			$arr = $arr." AND `com_name` = '$ccname'";
		}
		$sql="$arr";
		$result=mysqli_query($link,$sql); //執行sql指令
		$row_total = mysqli_num_rows($result);//取得資料表資料列數
	}
	
	if($mname != 'x'){
	echo '<table border="1" style = "font-size:18px;">'; 
	for ($y = 0;$y < 8;$y++){
			echo "<td align='center'>" .$m[$y]. "</td>";
	}
	for($y = 0;$y < $row_total;$y++){
		 $row = mysqli_fetch_row($result);
			echo "<tr><td align='center' >'$row[0]'</td>";
			echo "<td align='center' >'$row[1]'</td>";
			echo "<td align='center' >'$row[2]/$row[3]/$row[4]'</td>";
			echo "<td align='center' >'$row[5]/$row[6]/$row[7]'</td>";
			echo "<td align='center' >'$row[8]'</td>";
			echo "<td align='center' >'$row[9]'</td>";
			echo "<td align='center' >'$row[10]'</td>";
			$all = $row[1] * $row[8];
			echo "<td align='center' >'$all'</td>";
	}
	echo '</table>';
	}
	else if($pname != 'x'){
		echo '<table border="1" style = "font-size:18px;">'; 
		echo "<form method = 'post' action = 'search1.php'>";
		for ($y = 0;$y < 9;$y++){
			echo "<td align='center'>" .$p[$y]. "</td>";
		}
		for($y = 0;$y < $row_total;$y++){
		 $row = mysqli_fetch_row($result);
			echo "<tr><td align='center' >'$row[0]'</td>";
			echo "<td align='center' >'$row[1]'</td>";
			echo "<td align='center' >'$row[2]/$row[3]/$row[4]'</td>";
			echo "<td align='center' >'$row[5]/$row[6]/$row[7]'</td>";
			
			echo "<td align='center' >";
			echo "<select name = 'select'>";
			echo "<option value = 'x'>原: $row[9]</option>";
			$a = 'prepared';
			$b = 'picked';
			$c = 'preparing';
			$d = 'recieved';
			echo "<option value=" .$a.">" .$a. "</option>";
			echo "<option value=" .$b.">" .$b. "</option>";
			echo "<option value=" .$c.">" .$c. "</option>";
			echo "<option value=" .$d.">" .$d. "</option>";
			echo "</select>";
			echo "<input value='修改' type='submit' name ='revise'>
				  <input value = '$row[0]' type ='hidden' name = 'num'>";
			echo "</td>";
			
			echo "<td align='center' >'$row[10]'</td>";
			echo "<td align='center' >'$row[11]'</td>";
			echo "<td align='center' >'$row[12]'</td>";
			$all = $row[1] * $row[12];
			echo "<td align='center' >'$all'</td>";
		}
		echo '</form>';
		echo '</table>';
	}
	else if($pname == 'x' && $mname == 'x'){
		if($pro == 1){	
			$sql="SELECT * FROM `product_order` WHERE `com_name` = '$ccname'";
			if($year != 'x'){
				$sql="SELECT * FROM `product_order` WHERE `com_name` = '$ccname' AND `porder_datey` = '$year'";
				if($date != 'x')
					$sql="SELECT * FROM `product_order` WHERE `com_name` = '$ccname' AND `porder_datey` = '$year' AND `porder_datem` = '$date'";
			}
			$result=mysqli_query($link,$sql); //執行sql指令
			$row_total = mysqli_num_rows($result);//取得資料表資料列數
		
	echo '<table border="1" style = "font-size:18px;">'; 
	echo "<form method = 'post' action = 'search1.php'>";
	for ($y = 0;$y < 9;$y++){
			echo "<td align='center'>" .$p[$y]. "</td>";
	}
	for($y = 0;$y < $row_total;$y++){
		 $row = mysqli_fetch_row($result);
			echo "<tr><td align='center' >'$row[0]'</td>";
			echo "<td align='center' >'$row[1]'</td>";
			echo "<td align='center' >'$row[2]/$row[3]/$row[4]'</td>";
			echo "<td align='center' >'$row[5]/$row[6]/$row[7]'</td>";
			echo "<td align='center' >";
			echo "<select name = 'select'>";
			echo "<option value = 'x'>原: $row[9]</option>";
			$a = 'prepared';
			$b = 'picked';
			$c = 'preparing';
			$d = 'recieved';
			echo "<option value=" .$a.">" .$a. "</option>";
			echo "<option value=" .$b.">" .$b. "</option>";
			echo "<option value=" .$c.">" .$c. "</option>";
			echo "<option value=" .$d.">" .$d. "</option>";
			echo "</select>";
			echo "<input value='修改' type='submit' name ='revise'>
				  <input value = '$row[0]' type ='hidden' name = 'num'>";
			echo "</td>";
			echo "<td align='center' >'$row[10]'</td>";
			echo "<td align='center' >'$row[11]'</td>";
			echo "<td align='center' >'$row[12]'</td>";
			$all = $row[1] * $row[12];
			echo "<td align='center' >'$all'</td>";
	}
	echo '</form>';
	echo '</table>';
	
		}
		if($mat ==1){
			$sql="SELECT * FROM `material_order` WHERE `com_name` = '$ccname'";
			if($year != 'x'){
				$sql="SELECT * FROM `material_order` WHERE `com_name` = '$ccname' AND `morder_datey` = '$year'";
				if($date != 'x')
					$sql="SELECT * FROM `material_order` WHERE `com_name` = '$ccname' AND `porder_datey` = '$year' AND `morder_datem` = '$date'";
			}
			$result=mysqli_query($link,$sql); //執行sql指令
			$row_total = mysqli_num_rows($result);//取得資料表資料列數
		
			echo '<table border="1" style = "font-size:18px;">'; 
	for ($y = 0;$y < 8;$y++){
			echo "<td align='center'>" .$m[$y]. "</td>";
	}
	for($y = 0;$y < $row_total;$y++){
		 $row = mysqli_fetch_row($result);
			echo "<tr><td align='center' >'$row[0]'</td>";
			echo "<td align='center' >'$row[1]'</td>";
			echo "<td align='center' >'$row[2]/$row[3]/$row[4]'</td>";
			echo "<td align='center' >'$row[5]/$row[6]/$row[7]'</td>";
			echo "<td align='center' >'$row[8]'</td>";
			echo "<td align='center' >'$row[9]'</td>";
			echo "<td align='center' >'$row[10]'</td>";
			$all = $row[1] * $row[8];
			echo "<td align='center' >'$all'</td>";
	}
	echo '</table>';
		}
	
	}
}
if(isset($_POST['revise'])){
	$num = $_POST['num'];
	$type = $_POST['select'];
	$sql="UPDATE `product_order` SET `poder_state` = '$type' WHERE `poder_num` = '$num'";
	$result=mysqli_query($link,$sql); //執行sql指令
}
?>