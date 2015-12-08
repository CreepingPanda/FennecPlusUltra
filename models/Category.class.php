<?php

class Category
{


// ________ PROPRIETES ________
	private $database;

	private $id;

	private $name;
	private $description;
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
	public function getDescription()
	{
		return $this->description;
	}
// ________________


// ________ SETTERS ________
	public function setName($name)
	{
		if ( strlen($name) <= 255 )
		{
			$this->name = $name;
			return true;
		}
		else
		{
			throw new Exception("Nom incorrect. Oh mon dieu ! 255 caractères maximum.");
		}
	}
	public function setDescription($description)
	{
		if ( strlen($description) <= 511 )
		{
			$this->description = $description;
			return true;
		}
		else
		{
			throw new Exception("Argh ! 511 caractères maximum pour la description !");
		}
	}
// ________________


}

?>