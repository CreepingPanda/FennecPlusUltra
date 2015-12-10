<?php

if ( isset($_GET['action']) )
{

// ________ ADD ITEM ________
	if ( $_GET['action'] == 'add_item' )
	{
		if ( isset($_POST['quantity']) )
		{
			$quantity = $_POST['quantity'];
			$manager = new ItemManager($database);
			try
			{
				$item = $manager->findById($_GET['id']);
			}
			catch (Exception $e)
			{
				$errors[] = $e->getMessage();
			}

			if ( isset($_SESSION['id']) )
			{
				$manager = new CartManager($database);
				try
				{
					$add = $manager->addToCart($currentUser, $item, $quantity);
					header('Location: index.php?page=item&id='.$item->getId().'');
					exit;
				}
				catch (Exception $e)
				{
					$errors[] = $e->getMessage();
				}
			}
			else
			{
				if ( !isset($_SESSION['order']) )
				{
					$_SESSION['order'] = array();
				}

				for ( $i=0; $i<count($_SESSION['order']); $i++ )
				{
					$localItem = $_SESSION['order'][$i]['item'];
					$localQuantity = $_SESSION['order'][$i]['quantity'];
					if ( $localItem == $item->getId() )
					{
						$quantity = $localQuantity+$quantity;

						if ( $quantity > $item->getStock() )
						{
							$quantity = $item->getStock();
						}
						else if ( $quantity < 0 )
						{
							$quantity = 0;
						}

						$_SESSION['order'][$i]['item'] = $item->getId();
						$_SESSION['order'][$i]['quantity'] = $quantity;
						header('Location: index.php?page=item&id='.$item->getId().'');
						exit;
					}
				}

				if ( $quantity <= $item->getStock() )
				{
					$quantity = $quantity;
				}
				else
				{
					$quantity = $item->getStock();
				}

				$_SESSION['order'][] = array('item'=>$item->getId(), 'quantity'=>$quantity);
				header('Location: index.php?page=item&id='.$item->getId().'');
				exit;
			}
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