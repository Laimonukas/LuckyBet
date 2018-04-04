<html>
<head>
	<meta charset="UTF-8">
	<title>LuckyBet registracija</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<?php 
		include('headerLogo.php'); 
		session_start();
		if(isset($_SESSION['logedIn'])){
			if($_SESSION['logedIn']==true){
				header('Location: index.php');
			}
		}
	?>
	
	<div id="registerContainer">
		
		<form action="registerPOST.php" method="post" id="registerForm">
			Vardas:
			<input class="textFieldA" type="text" name="registerName"><br>
			Pavarde:
			<input class="textFieldA" type="text" name="registerLastname"><br>
			Slapyvardis:
			<input class="textFieldA" type="text" name="registerUsername"><br>
			Slaptažodis:
			<input class="textFieldA" type="password" name="registerPassword"><br>
			
			<input class="buttonA" type="submit" value="Registracija">
	
		</form>
		<br>arba <a class="linkTypeA" href="prisijungimas.php">Prisijungti</a>
		
		
		
		
	
	</div>
	
	
	<div class="clearfix"></div>
	
	
	
	


</body>


</html>