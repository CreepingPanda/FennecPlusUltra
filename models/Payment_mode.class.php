<?php

class Payment_mode
{


// ________ PROPRIETES ________
	private $database;
	private $id;
	private $name;
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
	public function getName()
	{
		return $this->name;
	}
// ________________

// ________ SETTERS ________
	public function setName($name)
	{
		if ( strlen($name) <= 63 )
		{
			$this->name = $name;
			return true;
		}
		else
		{
			return "Erreur nom du mode de livraison : 63 caractères maximum.";
		}
	}
// ________________


}

?>