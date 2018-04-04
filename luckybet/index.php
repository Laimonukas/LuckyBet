<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Bet website">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript,bets">
	<meta name="author" content="LaimonasJ">
	
	<title>LuckyBet</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	
</head>

<body>
	<?php 
		include('headerLogo.php');
	
	
		session_start();
		//check sessions
		if(isset($_SESSION['isAdmin'])){
			if($_SESSION['isAdmin']==true){
				header('Location: admin.php');
			}else{
				include('stickyHeaderLogedIn.php');
				
			}
		}else{
			include('stickyHeader.php');
		}
		
		
		
	
	
	?>



	<?php include('mainSportNav.php');?>
	
	
	
	
	
	
	
	
	





	<?php include('footer.php');?>
</body>
</html>