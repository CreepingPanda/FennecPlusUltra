<?php

class Photo_item
{


// ________ PROPRIETES ________
	private $database;
	
	private $id;

	private $id_item;
	private $item;

	private $url;
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
	public function getItem()
	{
		if ( !$this->item )
		{
			$manager = new ItemManager($this->database);
			$this->item = $manager->findById($this->id_item);
		}
		return $this->item;
	}
	public function getUrl()
	{
		return $this->url;
	}
// ________________


// ________ SETTERS ________
	public function setItem(Item $item)
	{
		$this->item = $item;
		$this->id_item = $item->getId();
		return true;
	}
	public function setUrl($url)
	{
		if ( strlen($url) <= 511 )
		{
			$this->url = $url;
			return true;
		}
		else
		{
			return "Erreur URL : 511 caractères maximum.";
		}
	}
// ________________


}

?>