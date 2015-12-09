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
	public function create(User $user)
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
	public function addToCart(Item $item, $quantity)
	{
		if ( is_object($item) )
		{
			$idItem = intval($item->getId());

			if ( is_int($quantity) )
			{
				if ( $quantity <= $item->getStock() )
				{
					$quantity = intval($quantity);
				}
				else
				{
					throw new Exception("Stocks insuffisants. Nous ajustons votre quantité.");
					$quantity = intval($item->getStock());
				}

				if ( $quantity )
				{
					if ( isset($_SESSION['id']) )
					{
						$idCart = intval($user->getCart()->getId());

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
						$_SESSION['cart_status'] = 1;
						$_SESSION['order'] = array();
						$_SESSION['order'][] = $idItem.', '.$quantity;
					}
				}
				else
				{
					throw new Exception("Pas de quantité, sérieusement ? ON ENVOIE AU HASARD ?");
				}
			}
			else
			{
				throw new Exception("La quantité doit être un nombre, vilain lutin violeur de lapins.");
			}
		}
		else
		{
			throw new Exception("Oh mon dieu, article introuvable !");
		}
	}
	public function logCart(User $user)
	{
		if ( $user )
		{
			if ( isset($_SESSION['cart_status']) && $_SESSION['cart_status'] == 1 )
			{
				if ( isset($_SESSION['order']) )
				{
					$manager = new ItemManager($this->database);

					for ( $i=0; $i<count($_SESSION['order']); $i++ )
					{
						$itemArray = explode(', ', $_SESSION['order'][$i]);
						// ____ 0 : $idItem \ 1 : $quantity ____

						$item = $manager->findById($itemArray[0]);
						if ( $item )
						{
							$quantity = $itemArray[1];
							$add = $hatis->addToCart($item, $quantity);
						}
						else
						{
							throw new Exception("Article ".$i." introuvable.");
						}
					}
				}
			}
		}
		else
		{
			throw new Exception("Erreur connexion utilisateur.");
		}
	}
// ________________


}

?>