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
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">薪資查詢</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="search.php" style = "color:blue">搜尋 -></a>
	<a href="search2.php" style = "color:blue">交易紀錄</p></a>
</section>
			
<form action="search2.php" method="POST">
<div class="features">
					<table border="1">
			

						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>員工</label>
							<select name = "name"><br>
　							<?PHP
							$sql="SELECT `emp_name` FROM `employee`"; //sql command
							$result=mysqli_query($link,$sql);
							$col_total = mysqli_num_fields($result);
							$row_total = mysqli_num_rows($result);
							echo "<option value = 'x'>-- 請選擇 --</option>"; //此行可有可無
							for($y=0;$y<$row_total;$y++){ //顯示資料成為select menu
								$row=mysqli_fetch_assoc($result);
								echo "<option value=".$y. ">" .$row['emp_name']. "</option>";
							}

							?>
							</select>
						</div></td>
						
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>年份</label>
							<select name="year">
						<?php
						 echo "<option value = 'x'>-- 請選擇 --</option>";
					 	 echo $taiwan_date = date('Y')-1911;
						 for($y = 0;$y < 10;$y++){
									$taiwan_date = (date('Y')-$y)-1911;
									echo "<option value=" .$taiwan_date.">" .$taiwan_date. "</option>";
								}
						?>
						</select></td></div>
						<!--<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>日期</label>
							<select name="date">
								<option value = 'x'>-- 請選擇 --</option>
　								<option value="1">1月</option>
　								<option value="2">2月</option>
								<option value="3">3月</option>
								<option value="4">4月</option>
								<option value="5">5月</option>
								<option value="6">6月</option>　								
　								<option value="7">7月</option>　								
　								<option value="8">8月</option>　								
								<option value="09">9月</option>　								
								<option value="10">10月</option>
　								<option value="11">11月</option>
　								<option value="12">12月</option>
　								
						</td></div>-->
						
						</table>
						<ul class="actions" style="text-align:center;">
							<li><input value="送出" type="submit" name ="deliver"></li>
						</ul>				
</div>			
</form>	
<?php
if(isset($_POST['deliver']))
{
	$name = $_POST['name'];
	$year = $_POST['year'];
	//$date = $_POST['date'];
	
	$sql="SELECT * FROM `employee`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $name){
			$num = $row['emp_num'];
		}
	}
	
	$a = array ("薪資編號","員工編號","本薪","伙食費","借支","應扣勞保","應扣健保","年份","日期","是否發薪","總計");
	
	if($name != 'x'){
		$arr="SELECT * FROM `salary` WHERE `emp_num` = '$num'" ;
		
		if($year != 'x'){
			$arr = $arr." AND `sal_year` = '$year'";
		
		/*if($date != 'x')
			$arr = $arr." AND `sal_date` = 'substr( $date , 0 , 1 )'";*/
		}
	}
	else if($year != 'x'){
		$arr = "SELECT * FROM `salary` WHERE `sal_year` = '$year'";
	}
	else{
		echo "<script>";
		 echo "alert('錯誤格式')";
		 echo "</script>";
	}
	
	$sql="$arr";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	
	echo '<table border="1" style = "font-size:18px;">'; 
	echo "<form method = 'post' action = 'search2.php'>";
	for ($y = 0;$y < 11;$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
	}
	for($y = 0;$y < $row_total;$y++){
			$row = mysqli_fetch_row($result);
			$num = $row[0];
			echo "<tr><td align='center' >'$row[0]'</td>";
			echo "<td align='center' >'$row[1]'</td>";
			echo "<td align='center' >'$row[2]'</td>";
			echo "<td align='center' >'$row[3]'</td>";
			echo "<td align='center' >'$row[4]'</td>";
			echo "<td align='center' >'$row[5]'</td>";
			echo "<td align='center' >'$row[6]'</td>";
			echo "<td align='center' >'$row[7]'</td>";
			echo "<td align='center' >'$row[8]'</td>";
			
			echo "<td align='center' >";
			echo "<select name = 'select'>";
			echo "<option value = 'x'>原狀態: $row[9]</option>";
			$a = yes;
			$b = no;
			echo "<option value=" .$a.">" .$a. "</option>";
			echo "<option value=" .$b.">" .$b. "</option>";
			echo "</select>";
			echo "<input value='修改' type='submit' name ='revise'>
				  <input value = '$num' type ='hidden' name = 'num'>";
			echo "</td>";
			
			$all = $row[2] - $row[3] - $row[4] +$row[5] + $row[6];
			echo "<td align='center' >'$all'</td>";
			
	}
	echo"</form>";
	echo '</table>';
	}
	
if(isset($_POST['revise'])){
	$num = $_POST['num'];
	$type = $_POST['select'];
	$sql="UPDATE `salary` SET `sal_state` = '$type' WHERE `sal_num` = '$num'";
	$result=mysqli_query($link,$sql); //執行sql指令
}
?>
