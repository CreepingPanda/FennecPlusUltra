<?php

class Shipping_modeManager
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
		$query = "SELECT * FROM shipping_mode WHERE id = ".$id;

		$result = $this->database->query($query);
		if ( $result )
		{
			$shipping_mode = $result->fetchObject("Cart", array($this->database));
			if ( $shipping_mode )
			{
				return $shipping_mode;
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
	public function create($name, $value, $method, $delay_min, $delay_max)
	{
		$shipping_mode = new Shipping_mode();

		if ( isset($_SESSION['id'] )
		{
			$idUser = intval($_SESSION['id']);
			$manager = new UserManager($this->database);
			$user = $manager->findById($idUser);

			if ( $user->getRights() == 2 )
			{
				$set = $shipping_mode->setName($name);
				if ( $set === true )
				{
					$set = $shipping_mode->setValue($value);
					if ( $set === true )
					{
						$set = $shipping_mode->setMethod($method);
						if ( $set === true )
						{
							$set = $shipping_mode->setDelayMin($delay_min);
							if ( $set === true )
							{
								$set = $shipping_mode->setDelayMax($delay_max);
								if ( $set === true )
								{
									$name = $this->database->quote($shipping_mode->getName());
									$value = $this->database->quote($shipping_mode->getValue());
									$method = $this->database->quote($shipping_mode->getMethod());
									$delay_min = $this->database->quote($shipping_mode->getDelayMin());
									$delay_max = $this->database->quote($shipping_mode->getDelayMax());

									$query "INSERT INTO shipping_mode (name, value, method, delay_min, delay_max)
										VALUES ('".$name."', ".$value.",  '".$method."', ".$delay_min.", ".$delay_max.")";

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
			throw new Exception ("Erreur : Connexion requise.");
		}
	}
	public function edit(Shipping_mode $shipping_mode)
	{
		$id = intval($shipping_mode->getId());

		$name = $this->database->quote($shipping_mode->getName());
		$value = $this->database->quote($shipping_mode->getValue());
		$method = $this->database->quote($shipping_mode->getMethod());
		$delay_min = $this->database->quote($shipping_mode->getDelayMin());
		$delay_max = $this->database->quote($shipping_mode->getDelayMax());

		$query = "UPDATE shipping_mode
			SET name = '".$name."', value = ".$value.",
			method = '".$method."', delay_min = ".$delay_min.",
			delay_max = ".$delay_max."
			WHERE id = ".$id;

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