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

		$result = $database->exec($query);
		if ( $result )
		{
			$cart = $result->fetchObject("Cart", array($this->database));
			if ( $cart )
			{
				return $cart;
			}
			else
			{
				return "Panier introuvable.";
			}
		}
		else
		{
			return "Erreur - Base de données.";
		}
	}






}

?>