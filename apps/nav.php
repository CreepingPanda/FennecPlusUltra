
<?php
	if (isset($_SESSION["id"])) 
	{
		require('views/nav_in.phtml');
	}
	else
	{
		require('views/nav_out.phtml');
	}

?>