<?php

class Ad_livraisonManager
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

		$query = "SELECT * FROM ad_livraison WHERE id = ".$id;

		$result = $this->database->query($query);
		if ( $result )
		{
			$ad_livraison = $result->fetchObject("Ad_livraison", array($this->database));
			if ( $ad_livraison )
			{
				return $ad_livraison;
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
		$ad_livraison = new Ad_livraison();

		if ( isset($_SESSION['id']) && $_SESSION['id'] == $user->getId())
		{
			$set = $ad_livraison->setAdress($address);
			if ( $set === true )
			{
				$set = $ad_livraison->setPostCode($post_code);
				if ( $set === true )
				{
					$set = $ad_livraison->setCity($city);
					if ( $set === true )
					{
						$set = $ad_livraison->setComplement($complement);
						if ( $set === true)
						{
							$idUser = intval($user->getId());
							$address = $this->database->quote($ad_livraison->getAddress());
							$postCode = $this->database->quote($ad_livraison->getPostCode());
							$city = $this->database->quote($ad_livraison->getCity());
							$complement = $this->database->quote($ad_livraison->getComplement());

							$query = "INSERT INTO ad_livraison(id_user, address, post_code, city, complement)
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
	public function edit(Ad_livraison $ad_livraison)
	{
		$id = intval($ad_livraison->getId());

		$address = $this->database->quote($ad_livraison->getAddress());
		$postCode = $this->database->quote($ad_livraison->getPostCode());
		$city = $this->database->quote($ad_livraison->getCity());
		$complement = $this->database->quote($ad_livraison->getComplement());

		$query = "UPDATE ad_livraison
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