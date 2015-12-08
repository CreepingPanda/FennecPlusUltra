<?php

class Ad_facturationManager
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

		$query = "SELECT * FROM ad_facturation WHERE id = ".$id;

		$result = $this->database->query($query);
		if ( $result )
		{
			$ad_facturation = $result->fetchObject("Ad_facturation", array($this->database));
			if ( $ad_facturation )
			{
				return $ad_facturation;
			}
			else
			{
				throw new Exception("Adresse introuvable.");
			}
		}
		else
		{
			throw new Exception("Erreur - Base de données.");
		}
	}
	public function create(User $user, $address, $post_code, $city, $complement)
	{
		$ad_facturation = new Ad_facturation();

		if ( isset($_SESSION['id']) && $_SESSION['id'] == $user->getId())
		{
			$set = $ad_facturation->setAdress($address);
			if ( $set === true )
			{
				$set = $ad_facturation->setPostCode($post_code);
				if ( $set === true )
				{
					$set = $ad_facturation->setCity($city);
					if ( $set === true )
					{
						$set = $ad_facturation->setComplement($complement);
						if ( $set === true)
						{
							$idUser = intval($user->getId());
							$address = $this->database->quote($ad_facturation->getAddress());
							$postCode = $this->database->quote($ad_facturation->getPostCode());
							$city = $this->database->quote($ad_facturation->getCity());
							$complement = $this->database->quote($ad_facturation->getComplement());

							$query = "INSERT INTO ad_facturation(id_user, address, post_code, city, complement)
								VALUES (".$idUser.", '".$address."', '".$postCode."', '".$city."', '".$complement."')";

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
			throw new Exception("Erreur compte utilisateur.");
		}
	}
	public function edit(Ad_facturation $ad_facturation)
	{
		$id = intval($ad_facturation->getId());

		$address = $this->database->quote($ad_facturation->getAddress());
		$postCode = $this->database->quote($ad_facturation->getPostCode());
		$city = $this->database->quote($ad_facturation->getCity());
		$complement = $this->database->quote($ad_facturation->getComplement());

		$query = "UPDATE ad_facturation
			SET address = '".$address."', post_code = '".$postCode."',
			city = '".$city."', complement = '".$complement."'
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