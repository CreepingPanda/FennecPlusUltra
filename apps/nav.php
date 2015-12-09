
<?php
	if (isset($_SESSION["id"])) 
	{
		if ($currentUser->getRights() == 2)
		{
			$url = 'admin';
			$name = 'Administration';
		}
		else
		{
			$url = 'cart';
			$name = 'Votre panier';
		}
		require('views/nav_in.phtml');
	}
	else
	{
		require('views/nav_out.phtml');
	}

?>