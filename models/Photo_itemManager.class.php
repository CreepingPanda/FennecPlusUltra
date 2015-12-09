<?php

class Photo_itemManager
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
		$query = "SELECT * FROM photo_item WHERE id = ".$id;

		$result = $this->database->query($query);
		if ( $result )
		{
			$photo_item = $result->fetchObject("Cart", array($this->database));
			if ( $photo_item )
			{
				return $photo_item;
			}
			else
			{
				throw new Exception("Photo introuvable.");
			}
		}
		else
		{
			throw new Exception("Erreur - Base de données.");
		}
	}
	public function add(Item $item, User $currentUser, $url)
	{
		$photo_item = new Photo_item($this->database);

		if ( $currentUser )
		{
			if ( $currentUser->getRights() == 2 )
			{
				$set = $photo_item->setItem($item);
				if ( $set === true )
				{
					$set = $photo_item->setUrl($url);
					if ( $set === true )
					{
						$idItem = intval($item->getId());
						$url = $this->database->quote($photo_item->getUrl());
						$query = "INSERT INTO photo_item (id_item, url)
							VALUES (".$idItem.", ".$url.")";
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
				throw new Exception("Droits d'administration requis.");
			}
		}
		else
		{
			throw new Exception("Connexion requise.");
		}
	}
// ________________


}

?>