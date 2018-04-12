


<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="whiteText">

<?php
	include("headerLogo.php");
	
	//check values
	if(!isset($_POST)){
		echo "Problema gaunant informacija<br>";
	}else{
		if(empty($_POST['registerName'])||strlen($_POST['registerName'])>250){
			echo "Vardas per ilgas arba jo nėra<br>";
			
			echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}
		
		if(empty($_POST['registerLastname'])||strlen($_POST['registerLastname'])>250){
			echo "Pavardė per ilga arba jos nėra<br>";
			
			echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}
		if(empty($_POST['registerUsername'])||strlen($_POST['registerUsername'])>250){
			echo "Slapyvardis per ilgas arba jo nėra<br>";
			
			echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}
		if(empty($_POST['registerPassword'])||strlen($_POST['registerPassword'])>250){
			echo "Slaptažodis per ilgas arba jo nėra<br>";
			
			echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}else{
			if(strlen($_POST['registerPassword'])<8){
				echo "Slaptažodis per trumpas.MIN 8 simboliai<br>";
				echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
				return;
			}
		}
		
		//connection to sql
		
		
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";
		
		$conn = mysqli_connect($serverName, $username, $password,$dbName);
		
		if (!$conn) {
			die("Prisijungti nepavyko: " . mysqli_connect_error());
			mysqli_close($conn);
			
			echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}
		//set char set to utf8
		//mysql_query("SET character_set_results = 'utf8mb4', character_set_client = 'utf8mb4', character_set_connection = 'utf8mb4', character_set_database = 'utf8mb4', character_set_server = 'utf8mb4'", $conn);
		$conn->query("SET NAMES utf8");
		//prepared statements
		$stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = (?)");
		$stmt->bind_param('s', $name); // 's' specifies the variable type => 'string'
		//set var
		$name=$_POST['registerUsername'];
		$stmt->execute();
			
		
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
		
		
		if($num_of_rows==0){
			
			//insert new user
			$stmt = $conn->prepare("INSERT INTO `users` (
															`name` ,
															`surname` ,
															`username` ,
															`password` ,
															`credits` ,
															`role`
																	)
									VALUES (
									?,?,?,?,?,?)");
			$stmt->bind_param('ssssii', $name,$lastname,$registerUsername,$registerPassword,$credits,$role);
			$credits=999;
			$role=0;
			$name=$_POST['registerName'];
			$lastname=$_POST['registerLastname'];
			$registerUsername=$_POST['registerUsername'];
			
			//encrypt password 
			$salt="abcdefgh12345678";
			$registerPassword=crypt($_POST['registerPassword'],$salt);
			$stmt->execute();
			
			//echo "Registracija sekminga.<a href='prisijungimas.php' class='linkOnBlack'>Prisijunkite</a>";
			//start session to send info to login page
			session_start();
			
			$_SESSION["registerSuccess"] = TRUE;
			$stmt->free_result();
			$stmt->close();
			mysqli_close($conn);
			header('Location: prisijungimas.php');
		
			
			
			
			
		}else{
			echo "Toks vartotojo slapyvardis jau egzistuoja,pasirinkite kitą<br>";
			$stmt->close();
			mysqli_close($conn);
			echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}
		
		
		
		$stmt->free_result();
		$stmt->close();
		mysqli_close($conn);
		
		
	}






?>


</div>
</body>
