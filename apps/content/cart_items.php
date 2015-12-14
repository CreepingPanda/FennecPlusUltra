<?php
	if ( isset($currentUser) )
	{
		$cart = $currentUser->getCart()->getItemList();
	}
	else if ( isset($_SESSION['order']) )
	{
		$manager = new ItemManager($database);
		for ( $i=0; $i<count($_SESSION['order']); $i++ )
		{
			$item = $manager->findById($_SESSION['order'][$i]['item']);
			$quantity = $_SESSION['order'][$i]['quantity'];
			if ( $quantity > 0 )
			{
				require('views/content/cart_items.phtml');
			}
		}
	}
?>