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
	 <h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">員工薪資</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="salary.php" style = "color:blue">薪資</p></a>
</section>
			
<form action="salary.php" method="POST">
<div class="features">
<table border="1">
						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>員工</label>
							<select name = "name"  required /><br>
　							<?PHP
							$sql="SELECT `emp_name` FROM `employee`"; //sql command
							$result=mysqli_query($link,$sql);
							$col_total = mysqli_num_fields($result);
							$row_total = mysqli_num_rows($result);
							echo "<option value=''>-- 請選擇 --</option>"; //此行可有可無
							for($y=0;$y<$row_total;$y++){ //顯示資料成為select menu
								$row=mysqli_fetch_assoc($result);
								echo "<option value=".$y. ">" .$row['emp_name']. "</option>";
							}

							?>
							</select>
						</div></td>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>本薪</label>
							<input name="salaryAll" type="text"  required />
						</div></td>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>伙食費</label>
							<input name="meal" type="text"  required />
						</div></td>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>借支</label>
							<input name="loan" type="text"  required />
						</div></td>
						<div class="form-control">
							<tr><td><label for="message" style = 'font-size:27px;'>應扣勞保</label>
							<input name="l_ins" type="text"  required />
						</div></td>	
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>應扣健保</label>
							<input name="h_ins" type="text"  required />
						</div></td>	
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>年份</label>
							<select name="year"  required />
						<?php
						
						 echo "<option value=''>-- 請選擇 --</option>";
					 	 echo $taiwan_date = date('Y')-1911;
						 for($y = 0;$y < 5;$y++){
									$taiwan_date = (date('Y')-$y)-1911;
									echo "<option value=" .$taiwan_date.">" .$taiwan_date. "</option>";
								}
						?>
						</select></td></div>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>日期</label>
							<select name="date"  required />
								<option value=''>-- 請選擇 --</option>
　								<option value="b_jan">1月-上</option>
　								<option value="e_jan">1月-下</option>
　								<option value="b_feb">2月-上</option>
　								<option value="e_feb">2月-下</option>
								<option value="b_mar">3月-上</option>
　								<option value="e_mar">3月-下</option>
								<option value="b_apr">4月-上</option>
　								<option value="e_apr">4月-下</option>
								<option value="b_may">5月-上</option>
　								<option value="e_may">5月-下</option>
								<option value="b_jun">6月-上</option>
　								<option value="e_jun">6月-下</option>
　								<option value="b_jul">7月-上</option>
　								<option value="e_jul">7月-下</option>
　								<option value="b_aug">8月-上</option>
　								<option value="e_aug">8月-下</option>
								<option value="b_sep">9月-上</option>
　								<option value="e_sep">9月-下</option>
								<option value="b_oct">10月-上</option>
　								<option value="e_oct">10月-下</option>
								<option value="b_nov">11月-上</option>
　								<option value="e_nov">11月-下</option>
								<option value="b_dec">12月-上</option>
　								<option value="e_dec">12月-下</option>	
						</td></div>
						<div class="form-control">
							<td><label for="message" style = 'font-size:27px;'>是否發薪</label>
							<select name="condition"  required />
								<option value=''>-- 請選擇 --</option>
　								<option value="yes">是</option>
　								<option value="no">否</option></select>
						</div></td>
</table>
				<ul class="actions" style="text-align:center;">
							<li><input value="確認" type="submit" name ="deliver"></li>
				</ul>	
</div>	
</form>	

<?php
if(isset($_POST['deliver']))
{
	$name = $_POST['name'];
	$salary = $_POST['salaryAll'];
	$meal = $_POST['meal'];
	$lins = $_POST['l_ins'];
	$hins = $_POST['h_ins'];
	$loan = $_POST['loan'];
	$year = $_POST['year'];
	$date = $_POST['date'];
	$state = $_POST['condition'];
	
	$sql="SELECT * FROM `employee`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	for($y = 0;$y < $row_total;$y++){
		$row = mysqli_fetch_assoc($result);
		if($y == $name){
			$Nname = $row['emp_name'];
			$num = $row['emp_num'];
		}
	}
	$a = array ("員工名稱","本薪","伙食費","借支","應扣勞保","應扣健保","年份","日期","是否發薪","總計","確認","取消");
	echo '<form action = "salary.php" method ="post">';
	{if($date=='b_jan')
		$date="1月-上";
	if($date=='e_jan')
		$date="1月-下";
	if($date=='b_feb')
		$date="2月-上";
	if($date=='e_feb')
		$date="2月-下";
	if($date=='b_mar')
		$date="3月-上";
	if($date=='e_mar')
		$date="3月-下";
	if($date=='b_apr')
		$date="4月-上";
	if($date=='e_apr')
		$date="4月-下";
	if($date=='b_may')
		$date="5月-上";
	if($date=='e_may')
		$date="5月-下";
	if($date=='b_jun')
		$date="6月-上";
	if($date=='e_jun')
		$date="6月-下";
	if($date=='b_jul')
		$date="7月-上";
	if($date=='e_jul')
		$date="7月-下";
	if($date=='b_aug')
		$date="8月-上";
	if($date=='e_aug')
		$date="8月-下";
	if($date=='b_sep')
		$date="9月-上";
	if($date=='e_sep')
		$date="9月-下";
	if($date=='b_oct')
		$date="10月-上";
	if($date=='e_oct')
		$date="10月-下";
	if($date=='b_nov')
		$date="11月-上";
	if($date=='e_nov')
		$date="11月-下";
	if($date=='b_dec')
		$date="12月-上";
	if($date=='e_dec')
	$date="12月-下";}
	echo '<table border="1" style = "font-size:18px;">'; 
	    for ($y = 0;$y < 12;$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	       echo "<tr><td align='center' ><input type = 'hidden' name = 'name' value = '$num'>'$Nname'</font></td>";
			echo "<td align='center' ><input type = 'hidden' name = 'salaryAll' value = '$salary'>'$salary'元</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'meal' value = '$meal'>'$meal'元</td>";
				echo "<td align='center' ><input type = 'hidden' name = 'loan' value = '$loan'>'$loan'元</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'l_ins' value = '$lins'>'$lins'元</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'h_ins' value = '$hins'>'$hins'元</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'year' value = '$year'> '$year 年'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'date' value = '$date'> '$date'</td>";
			echo "<td align='center' ><input type = 'hidden' name = 'condition' value = '$state'>'$state'</td>";
			$money=($salary+$loan+$meal)-($lins+$hins);
			echo "<td align='center'>'$money' 元</td>";
			echo "<td align='center'><input value='確認' type='submit' name = 'submit'></td>";
			echo "<td align='center'><input value='取消' type='submit' name = 'delete'></td>";
	echo '</table>';
	echo '</form>';

}

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$salary = $_POST['salaryAll'];
	$meal = $_POST['meal'];
	$lins = $_POST['l_ins'];
	$hins = $_POST['h_ins'];
	$loan = $_POST['loan'];
	$year = $_POST['year'];
	$date = $_POST['date'];
	$state = $_POST['condition'];
	
	$sql="INSERT INTO `salary`(`emp_num`,`meal`,`h_insurance`,`l_insurance`,`loan`,`sal_total`,`sal_year`,`sal_date`,`sal_state`)	
						VALUE('$name','$meal','$hins','$lins','$loan','$salary','$year','$date','$state');";
	$result=mysqli_query($link,$sql);
	
	
	mysqli_close($link);
}
?>