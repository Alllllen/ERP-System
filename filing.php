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

<section id = "footer" style="background-color: #E0FFFF;">
	<h2>建檔</h2>
	<a href="index.php" style = "color:blue"><p>BETTIA -> 
	<a href="filing.php" style = "color:blue">建檔</p></a>
</section>
			
	<section id="one" class="wrapper special">
		<div class="inner">
			<div class="features">
						<div class="feature"><a href="file1.php">
							<i class="fa fa-building"></i>
							<h3 style="font-weight:bold;">公司資料</h3></a>
							<p style="color:#AAAAAA;font-style:italic;">[公司基本資料]</p>
						</div>
						<div class="feature" ><a href="file2.php">
							<i class="fa fa-users" ></i>
							<h3 style="font-weight:bold;">員工資料</h3></a>
							<p style="color:#AAAAAA;font-style:italic;">[員工基本資料]</p>
						</div>
						<div class="feature" ><a href="file3.php">
							<i class="fa fa-shield" ></i>
							<h3 style="font-weight:bold;">商品種類</h3></a>
							<p style="color:#AAAAAA;font-style:italic;">[新增商品種類. . .]</p>
						</div>
						<div class="feature"><a href="file4.php">
							<i class="fa fa fa-leaf"></i>
							<h3 style="font-weight:bold;">原料種類</h3></a>
							<p style="color:#AAAAAA;font-style:italic;">[新增原料種類. . .]</p>
							
						</div>	
								
			</div>
		</div>
	</section>
