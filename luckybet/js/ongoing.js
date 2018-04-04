var auto_refresh = setInterval(
	(function () {
		$("#ongoingDiv").load("ongoing.php");
	}), 10000);//10s
