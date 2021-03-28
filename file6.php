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
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">建檔(原料庫存)</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="filing.php" style = "color:blue">建檔 ->
	<a href="file6.php" style = "color:blue">原料庫存</p></a>
</section>
			
<?php
if(isset($_POST['deliver']))
{
	$num = $_POST['num'];
	$name = $_POST['name'];
	$weight = $_POST['weight'];

	$sql="INSERT INTO `material_stock`(`mstock_num`,`mstock_name`,`mstock_weight`)	
		  VALUE('$num','$name','$weight');";
		
	$result=mysqli_query($link,$sql);
}
  $a = array ("原料編號","品名","重量");
  
  $sql="SELECT * FROM `material_stock`";
  $result=mysqli_query($link,$sql); //執行sql指令
  $col_total = mysqli_num_fields($result);
  $row_total = mysqli_num_rows($result);//取得資料表資料列數
  echo "<br/>筆數=$row_total<br />";


  echo '<table border="1" style = "font-size:25px;">';
	 
	    for ($y = 0;$y<($col_total);$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	
  for ($y = 0;$y<($row_total);$y++){
	  echo '<form action = "file6.php" method ="post">';
    $row = mysqli_fetch_row($result);
	$nname = $row[0];
	$num = $row[0];
	$name = $row[1];
	$weight = $row[2];
	
	        echo "<tr><td align='center'>$num</td>";
			echo "<td align='center'>$name</td>";
			echo "<td align='center'><input type='text' name='weight'  value ='$weight'></td>";
			echo "<td align='center'><input value='修改' type='submit' name = 'revise'><input value='$nname' type='hidden' name = 'nname'></td></tr>";
			
		
	echo '</form>';
  }
echo '</table>';

if(isset($_POST['revise'])){
	
	$nname = $_POST['nname'];
	$weight = $_POST['weight'];
	
	$sql="UPDATE `material_stock` SET `mstock_weight`='$weight'
								 WHERE `mstock_num` = '$nname' ";	
		 
	$result=mysqli_query($link,$sql); 
	echo '<meta http-equiv="refresh" content="0;url=file6.php">';
}
  mysqli_close($link);
?>