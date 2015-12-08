<?php

class Comment
{


// ________ PROPRIETES ________
	private $database;

	private $id;

	private $id_author;
	private $author;

	private $id_item;
	private $item;

	private $content;
	private $note;
// ________________


// ________ CONSTRUCT ________
	public function __construct($database)
	{
		$this->database = $database;
	}
// ________________


// ________ GETTERS ________
	public function getId()
	{
		return $this->id;
	}
	public function getAuthor()
	{
		if ( !$this->author )
		{
			$manager = new UserManager($this->database);
			$this->author = $manager->findById($this->id_author);
		}
		return $this->author;
	}
	public function getItem()
	{
		if ( !$this->item )
		{
			$manager = new ItemManager($this->database);
			$this->item = $manager->findById($this->id_item);
		}
		return $this->item;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function getNote()
	{
		return $this->note;
	}
// ________________


// ________ SETTERS ________
	public function setAuthor(User $user)
	{
		$this->author = $user;
		$this->id_author = $user->getAuthor()->getId();
		return true;
	}
	public function setItem(Item $item)
	{
		$this->item = $item;
		$this->id_item = $item->getItem()->getId();
		return true;
	}
	public function setContent($content)
	{
		if ( strlen($content) <= 511 )
		{
			$this->content = $content;
			return true;
		}
		else
		{
			throw new Exception("Commentaire : 511 caractères maximum. Votre PC va désormais s'auto-détruire.");
		}
	}
	public function setNote($note)
	{
		if ( is_int($note) )
		{
			if ( $int >= 0 && $int <= 5 )
			{
				$this->note = $note;
				return true;
			}
			else
			{
				throw new Exception("La note doit être comprise entre 0 et 5, petit lapin !");
			}
		}
		else
		{
			throw new Exception("La note doit être un nombre. N'essayez pas de me la faire à l'envers !");
		}
	}
// ________________


}

?>