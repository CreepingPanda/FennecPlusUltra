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
			if ( isset($_SESSION['order']) )
			{
				for ($i=0; $i<count($_SESSION['order']); $i++ )
				{
					if ( $item->getId() == $_SESSION['order'][$i]['item'] )
					{
						$quantity = $_SESSION['order'][$i]['quantity'];
						break;
					}
					else
					{
						$quantity = 0;
					}
				}
			}
			else
			{
				$quantity = $item->getQuantity();
			}
			
			if ( !isset($quantity) )
			{
				$quantity = 0;
			}
			$minValue = $quantity;
			$maxValue = $item->getStock() - $quantity;

			if ( $maxValue > 0 )
			{
				$defaultValue = 1;
			}
			else
			{
				$defaultValue = 0;
			}

			require('views/content/item.phtml');
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