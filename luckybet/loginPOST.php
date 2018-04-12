<head>
	<meta charset="UTF-8">
	<title>LuckyBet prisijungimas</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="whiteText">
	<?php 
		include('headerLogo.php');
		
		session_start();
		
		
		if(isset($_POST)){
			if(!empty($_POST['loginUsername'])&&!empty($_POST['loginPassword'])){
				//connection to sql
				
				$serverName='localhost';
				$username = "root";
				$password = "usbw";
				$dbName="luckybet";
		
				$conn = mysqli_connect($serverName, $username, $password,$dbName);
		
				if (!$conn) {
					die("Prisijungti nepavyko: " . mysqli_connect_error());
					mysqli_close($conn);
			
					echo '<a href="prisijungimas.php" class="linkOnBlack">Grįžti atgal</a><br>';
					return;
				}
				//set charset
				//mysql_query("SET character_set_results = 'utf8mb4', character_set_client = 'utf8mb4', character_set_connection = 'utf8mb4', character_set_database = 'utf8mb4', character_set_server = 'utf8mb4'", $conn);
				$conn->query("SET NAMES utf8");
				
				$stmt = $conn->prepare("SELECT `userID`,`password`,`credits`,`role` FROM `users` WHERE `username` = (?)");
				$stmt->bind_param('s', $name); // 's' specifies the variable type => 'string'
				//set var
				$name=$_POST['loginUsername'];
				$stmt->execute();
				
				
		
				$result = $stmt->get_result();
				
				$num_of_rows = $result->num_rows;
				$result = $result->fetch_assoc();
				if($num_of_rows==0){
					echo "Vartotojas nerastas<br>";
					echo '<a href="prisijungimas.php" class="linkOnBlack">Grįžti atgal</a><br>';
					mysqli_close($conn);
					return;
				}else{
					
					$salt="abcdefgh12345678";
					$loginPassword=crypt($_POST['loginPassword'],$salt);
					if($loginPassword==$result['password']){
						$_SESSION["logedIn"] = TRUE;
						$_SESSION["username"] = $name;
						(float)$_SESSION["credits"] = $result['credits'];
						$_SESSION["userID"]=$result['userID'];
						
						
						
						$stmt->free_result();
						$stmt->close();
						mysqli_close($conn);
						
						if($result['role']==0){
							header('Location: index.php');
							$_SESSION['isAdmin']=FALSE;
						}else{
							header('Location: admin.php');
							$_SESSION['isAdmin']=TRUE;
						}
						
						
						
					}else{
						echo "Neteisingas slaptažodis<br>";
						echo '<a href="prisijungimas.php" class="linkOnBlack">Grįžti atgal</a><br>';
						mysqli_close($conn);
						return;
					}
				}
				mysqli_close($conn);
				
			}else{
				echo "Prisijungimo duomenys neivesti<br>";
				echo '<a href="prisijungimas.php" class="linkOnBlack">Grįžti atgal</a><br>';
				return;
			}
		}else{
			echo "Klaida gaunant duomenis<br>";
			echo '<a href="prisijungimas.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}
		
	
	
	
	
	
	
	?>



</div>
</body>