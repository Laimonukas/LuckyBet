<body>


	<?php
		session_start();
		$_SESSION = array();
		session_destroy();
		header('Location: prisijungimas.php');
		
		
	
	
	
	?>


</body>