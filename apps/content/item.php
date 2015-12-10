<?php
	if ( isset($_GET['id']) )
	{
		$manager = new ItemManager($database);
		try
		{
			$item = $manager->findById($_GET['id']);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}

		if ( $item )
		{
			require('views/content/item.phtml');
			var_dump($_SESSION);
		}
		else
		{
			require('apps/content/home.php');
		}
	}
	else
	{
		require('apps/content/home.php');
	}


?>