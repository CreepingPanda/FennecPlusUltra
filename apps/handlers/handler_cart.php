<?php

if ( isset($_GET['action']) )
{

// ________ ADD ITEM ________
	if ( $_GET['action'] == 'add_item' )
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

		$manager = new CartManager($database);
		try
		{
			$add = $manager->addToCart($item, $_POST['quantity']);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
	}
// ________________

// ________ ADD AD_LIVRAISON ________
	else if ( $_GET['action'] == 'add_ad_livraison' )
	{
	}
// ________________

}

?>