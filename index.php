<?php
require_once 'db.php';
?>
<?php
	session_start();
	if($_SESSION["login_session"] ==  false){
		header("Location:login.php");
	}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>BETTIA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" href="assets/css/main.css" />
		
	</head>
	
	<body>

		<!-- Banner -->
		<?php
			if($_SESSION["login_session"] == true){ 
	           echo "Welcome ,";
			   echo $_SESSION['name_session'];
			   
			   echo "<form action='index.php' method='POST'>";
			   echo "<input type='submit' name='logout' value='登出' font-size:17;'>";
			   echo "</form>";
			   
			   if(isset($_POST['logout']))
			   {
		          $_SESSION["login_session"] = false;
			      header('Location:login.php');
			   }
			 }
		?>
			<section id="banner">
				<h2><strong>匯羅股份有限公司</strong><br> 進銷存&薪資管理系統</h2><br>
				
				<p>Copyright © 2018 Bettia TW, Inc. All rights reserved.</p>
			</section>

		<!-- One -->
			<section id="one" class="wrapper special">
				<div class="inner">
					<header class="major">
						<h2>項目</h2>
					</header>
					<div class="features">
						<div class="feature">
							<a href="manufacture.php"><i class="fa fa fa-wrench"></i>
							<h3  style="font-weight:bold;">生產紀錄</h3></a>
							<p style="color:#AAAAAA;font-style:italic;">[記錄生產線資訊]</p>
						</div>
						<div class="feature" >
							<a href="material.php"><i class="fa fa-truck" ></i>
							<h3 style="font-weight:bold;">進貨登錄</h3></a>
							<p style="color:#AAAAAA;font-style:oblique;">[登錄買入原料資訊]</p>
						</div>
						<div class="feature">
							<a href="selling.php"><i class="fa fa-paper-plane-o"></i>
							<h3  style="font-weight:bold;">出貨登錄</h3></a>
							<p style="color:#AAAAAA;font-style:oblique;">[登錄賣出商品資訊]</p>
						</div>
						<div class="feature">
							<a href="search.php"><i class="fa fa-search"></i>
							<h3  style="font-weight:bold;">查詢</h3></a>
							<p style="color:#AAAAAA;font-style:oblique;">[查詢歷年來買賣交易、公司聯絡資訊及員工資料...等等]</p>
						</div>
						<div class="feature">
							<a href="salary.php"><i class="fa fa-user"></i>
							<h3  style="font-weight:bold;">薪資</h3></a>
							<p style="color:#AAAAAA;font-style:oblique;">[計算員工薪資]</p>
						</div>
						<div class="feature">
							<a href="filing.php"><i class="fa fa-save"></i>
							<h3  style="font-weight:bold;">建檔</h3></a>
							<p style="color:#AAAAAA;font-style:oblique;">[建檔公司資料、員工資料、原料種類、商品種類...等等]</p>
						</div>
					</div>
				</div>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="copyright">
					&copy; Untitled. Design: <a href="http://templated.co/">TEMPLATED</a>.
				</div>
			</footer>

	</body>
</html>