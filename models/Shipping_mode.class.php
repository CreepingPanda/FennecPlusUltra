<?php

class Shipping_mode
{


// ________ PROPRIETES ________
	private $database;

	private $id;

	private $name;
	private $value;
	private $method;
	private $delay_min;
	private delay_max;
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
	public function getValue()
	{
		return $this->value;
	}
	public function getMethod()
	{
		return $this->method;
	}
	public function getDelayMin()
	{
		return $this->delay_min;
	}
	public function getDelaymax()
	{
		return $this->delay_max;
	}
// ________________


// ________ SETTERS ________
	public function setName($name)
	{
		if ( strlen($name) <= 511 )
		{
			$this->name = $name;
			return true;
		}
		else
		{
			return "Nom incorrect : 511 caractères maximum.";
		}
	}
	public function setValue($value)
	{
		if (  is_float($value) )
		{
			if ( strlen($value) <= 63 )
			{
				$this->value = $value;
				return true;
			}
			else
			{
				return "Erreur valeur : 63 caractères maximum.";
			}
		}
		else
		{
			return "Erreur valeur : Nombre requis.";
		}
	}
	public function setMethod($method)
	{
		if ( strlen($method) <= 63 )
		{
			$this->method = $method;
			return true;
		}
		else
		{
			return "Erreur méthode : 63 caractères maximum.";
		}
	}
	public function setDelayMin($delay_min)
	{
		if ( is_int($delay_min) )
		{
			if ( strlen($delay_min) <= 31 )
			{
				$this->delay_min = $delay_min;
				return true;
			}
			else
			{
				return "Erreur délai min. : 31 caractères maximum.";
			}
		}
		else
		{
			return "Erreur délai min. : Nombre entier requis.";
		}
	}
	public function setDelayMax($delay_max)
	{
		if ( is_int($delay_max) )
		{
			if ( strlen($delay_max) <= 31 )
			{
				$this->delay_max = $delay_max;
				return true;
			}
			else
			{
				return "Erreur délai max. : 31 caractères maximum.";
			}
		}
		else
		{
			return "Erreur délai max. : Nombre entier requis.";
		}
	}
// ________________


}

?>