<?php

class CategoryManager
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

		$query = "SELECT * FROM category WHERE id = ".$id;

		$result = $this->database->query($query);
		if ( $result )
		{
			$category = $result->fetchObject("Category", array($this->database));
			if ( $category )
			{
				return $category;
			}
			else
			{
				throw new Exception("Catégorie introuvable.");
			}
		}
		else
		{
			throw new Exception("Erreur - Base de données.");
		}
	}
	public function create(User $currentUser, $name, $description)
	{
		$category = new Category();

		if ( $currentUser )
		{
			if ( $currentUser->getRights() == 2 )
			{
				$set = $category->setName($name);
				if ( $set === true )
				{
					$set = $category->setDescription($description);
					if ( $set === true )
					{
						$name = $this->database->quote($category->getName());
						$description = $this->database->quote($category->getDescription());
						$query = "INSERT INTO category (name, description)
							VALUES ('".$name."', '".$description."')";

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
				throw new Exception("Erreur : Droits d'administration requis.");
			}
		}
		else
		{
			throw new Exception("Erreur : Connexion requise.");
		}
	}
	public function edit(User $currentUser, Category $category)
	{
		$id = intval($category->getId());

		$name = $this->database->quote($category->getName());
		$description = $this->database->quote($category->getDescription());

		$query = "UPDATE category SET name = '".$name."', description = '".$description."' WHERE id = ".$id;
		
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