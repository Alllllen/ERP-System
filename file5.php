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
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">建檔(商品庫存)</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="filing.php" style = "color:blue">建檔 ->
	<a href="file5.php" style = "color:blue">商品建檔</p></a>
</section>
<?php
if(isset($_POST['deliver']))
{
	//$num = $_POST['num'];
	$name = $_POST['name'];
	$weight = $_POST['weight'];
	
	$sql="SELECT * FROM `product_stock`";
	$result=mysqli_query($link,$sql); //執行sql指令
	$row_total = mysqli_num_rows($result);//取得資料表資料列數
	$num = $row_total;
	
	
	$sql="INSERT INTO `product_stock`(`pstock_num`,`pstock_name`,`pstock_weight`)	
		  VALUE('$num','$name','$weight');";

		  
		
	$result=mysqli_query($link,$sql);
}
  $a = array ("商品編號","品名","重量");
  
  $sql="SELECT * FROM `product_stock`";
  $result=mysqli_query($link,$sql); //執行sql指令
  $col_total = mysqli_num_fields($result);
  $row_total = mysqli_num_rows($result);//取得資料表資料列數
  echo "<br/>筆數=$row_total<br />";


  echo '<table border="1" style = "font-size:25px;">';
	 
	    for ($y = 0;$y<($col_total);$y++){
			echo "<td align='center'>" .$a[$y]. "</td>";
		}
	
  for ($y = 0;$y<($row_total);$y++){
	  echo '<form action = "file5.php" method ="post">';
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
	
	$sql="UPDATE `product_stock` SET `pstock_weight`='$weight'
								 WHERE `pstock_num` = '$nname' ";	
		 
	$result=mysqli_query($link,$sql); 
	echo '<meta http-equiv="refresh" content="0;url=file5.php">';
}
  mysqli_close($link);
?>