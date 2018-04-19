<html>
<head>
	<meta charset="UTF-8">
	<title>LuckyBet prisijungimas</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<?php include('headerLogo.php'); ?>
	
	
	
	
	<div id="loginContainer">
		<div>
		<?php 
			session_start();
			//check sessions
			if(isset($_SESSION['logedIn'])){
				if($_SESSION['logedIn']==true){
					header('Location: index.php');
				}
			}
				
			
			if(isset($_SESSION['registerSuccess'])){
				if($_SESSION['registerSuccess']==true){
					echo "Registracija sėkminga.<br>";
				}else{
					echo '<a class="linkTypeA floatLeft textAlignCenter" href="registracija.php">Registracija</a>';
				}
			}else{
				echo '<a class="linkTypeA floatLeft textAlignCenter" href="registracija.php">Registracija</a>';
			}
		?>
			<a class="linkTypeA floatLeft textAlignCenter" href="index.php">Pagrindinis</a>
		</div>
		<form action="loginPOST.php" method="post" id="loginForm">
			Slapyvardis:<br>
			<input class="textFieldA" type="text" name="loginUsername"><br>
			Slaptažodis:<br>
			<input class="textFieldA" type="password" name="loginPassword"><br>
			<input class="buttonA" type="submit" value="Prisijungti">
	
		</form>
	
	
	</div>
	<div class="clearfix"></div>
	
	
	
	


</body>


</html>