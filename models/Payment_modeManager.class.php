<?php

class Payment_modeManager
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
		$query = "SELECT * FROM payment_mode WHERE id = ".$id;
		
		$result = $this->database->query($query);
		if ( $result )
		{
			$payment_mode = $result->fetchObject("Payment_mode", array($this->database));
			if ( $payment_mode )
			{
				return $payment_mode;
			}
			else
			{
				throw new Exception("Mode de paiement introuvable.");
			}
		}
		else
		{
			throw new Exception("Erreur - Base de données.");
		}
	}
	public function create(User $currentUser, $name)
	{
		$payment_mode = new Payment_mode();

		if ( $currentUser )
		{
			if ( $currentUser->getRights() == 2)
			{
				$set = $payment_mode->setName($name);
				if ( $set === true )
				{
					$name = $this->database->quote($payment_mode->getName());
					$query = "INSERT INTO payment_mode (name) VALUES ('".$name."')";

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
				throw new Exception("Erreur : Droits d'administration requis.");
			}

		}
		else
		{
			throw new Exception("Erreur : Connexion requise.");
		}
	}
	public function edit(User $currentUser, Payment_mode $payment_mode);
	{
		$id = intval($payment_mode->getId());

		$name = $this->database->quote($payment_mode->getName());
		$query = "UPDATE payment_mode SET name = '".$name."' WHERE id = ".$id;

		$result = $this->database->exec($query);
		if ( $result )
		{
			return true;
		}
		else
		{
			throw new Exception("Catastrophe base de données.");
		}
	}
// ________________


}

?>