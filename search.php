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

<section id = "footer" style="background-color: #E0FFFF;" >
	<h2 style="text-align:center;font-size:2em;font-family:fantasy;font-weight:bold;">查詢</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="search.php" style = "color:blue">查詢</p></a>
</section>
			
	<section id="one" class="wrapper special">
		<div class="inner">
			<div class="features">
						<div class="feature"><a href="search3.php">
							<i class="fa fa-suitcase"></i>
							<h3 style="font-weight:bold;">庫存</h3></a>
							<p style="color:#AAAAAA;font-style:italic;">[目前原料與商品庫存狀況...]</p>
						</div>
						<div class="feature" >
							<a href="search2.php"><i class="fa fa-street-view " ></i>
							<h3 style="font-weight:bold;">薪資</h3></a>
							<p style="color:#AAAAAA;font-style:italic;">[搜尋員工薪資狀況</br>以及歷年發薪狀況...]</p>
						</div>
						<div class="feature" >
							<a href="search1.php"><i class="fa fa-server" ></i>
							<h3 style="font-weight:bold;">歷年交易記錄</h3></a>
							<p style="color:#AAAAAA;font-style:italic;">[搜尋之前交易的記錄.... . .]</p>
						</div>
		
			</div>
		</div>
	</section>
