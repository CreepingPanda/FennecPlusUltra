<?php

class CartManager
{


// ________ PROPRIETES ________
	private $database;
// ________________


// ________ CONSTRUCT ________
	public function __construct($database)
	{
		$this->database = $database;
	}
// ________________


// ________ METHODES ________
	public function findById($id)
	{
		$id = intval($id);

		$query = "SELECT * FROM cart WHERE id = ".$id;
		$result = $this->database->query($query);

		if ( $result )
		{
			$cart = $result->fetchObject("Cart", array($this->database));
			if ( $cart )
			{
				return $cart;
			}
			else
			{
				throw new Exception("Panier introuvable.");
			}
		}
		else
		{
			throw new Exception("Erreur - Base de données.");
		}
	}
	public function createCart(User $user)
	{
		$cart = new Cart();

		if ( isset($_SESSION['id']) )
		{
			$set = $cart->setUser($user);
			if ( $set === true )
			{
				$set = $cart->setStatus(1);
				if ( $set === true )
				{
					$idUser = intval($cart->getUser()->getId());
					$status = intval($cart->getStatus());
					$query = "INSERT INTO cart (id_user, status) VALUES (".$idUser.", ".$status.")";

					$result = $this->database->exec($query);
					if ( $result )
					{
						$id = $this->database->lastInsertId();
						if ( $id )
						{
							return $this->findById($id);
						}
						else
						{
							throw new Exception("Catastrophe serveur.");
						}
					}
					else
					{
						throw new Exception("Catastrophe base de données.");
					}
				}
				else
				{
					throw new Exception($set);
				}
			}
			else
			{
				throw new Exception($set);
			}
		}
		else
		{
			$_SESSION['cartStatus'] = 1;
		}
	}
	public function logCart(User $user)
	{
		if ( isset($_SESSION['cartStatus']) && $_SESSION['cartStatus'] == 1 )
		{
			$cart = $user->getCart();
			if ( $cart && isset($_SESSION['item'])
			{
				$idUser = intval($user->getId());
				$outItemList = $_SESSION['item'];
				$idItem = '';
				
				$query = "INSERT INTO order (id_user, id_item) VALUES (".$idUser.", ".$idItem.")";
				$prepared = $this->database->prepare($query);

				for ( $i=0; $i<count($outItemList); $i++ )
				{
					$idItem = intval($outItemList[$i]);
					$prepared->execute();
				}
				$prepared->closeCursor();
			}
		}
	}
	public function addToCart(Item $item, User $user, $quantity)
	{
		if ( $item )
		{
			$idItem = intval($item->getId());

			if ( isset($_SESSION['id']) )
			{
				$idCart = intval($user->getCart()->getId());
				$quantity = intval($quantity);

				$query = "INSERT INTO order (id_cart, id_item, quantity) VALUES (".$idCart.", ".$idItem.", ".$quantity.")";

				$result = $this->database->exec($query);
				if ( $result )
				{
					$id = $this->database->lastInsertId();
					if ( $id )
					{
						return $this->findById($id);
					}
					else
					{
						throw new Exception("Catastrophe serveur.");
					}
				}
				else
				{
					throw new Exception("Catastrophe base de données.");
				}
			}
			else
			{
				$_SESSION['item'] = $idItem;
			}
		}
		else
		{
			throw new Exception("Oh mon dieu, article introuvable !");
		}
	}
// ________________


}

?>