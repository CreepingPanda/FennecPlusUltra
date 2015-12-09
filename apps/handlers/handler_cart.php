<?php

if ( isset($_GET['action']) )
{

// ________ ADD TO CART ________
	if ( $_GET['action'] == 'add' )
	{
		$manager = new ItemManager($database);
		try
		{
			$item = $manager->findById($_GET['id']);
			$cart = $currentUser->getCart()->addToCart($item, $currentUser, $_POST['quantity']);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
	}








}

?>