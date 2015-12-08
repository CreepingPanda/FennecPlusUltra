<?php

class Ad_facturation
{


// ________ PROPRIETES ________
	private $database;

	private $id_user;
	private $user

	private $address;
	private $post_code;
	private $city;
	private $complement;
// ________________


// ________ CONSTRUCT ________
	public function __construct($database)
	{
		$this->database = $database;
	}


// ________ GETTERS ________
	public function getId()
	{
		return $this->id;
	}
	public function getUser()
	{
		if ( !$this->user )
		{
			$manager  = new UserManager($this->database);
			$this->user = $manager->findById($this->id_user);
		}
		return $this->user;
	}
	public function getAddress()
	{
		return $this->address;
	}
	public function getPostCode()
	{
		return $this->post_code;
	}
	public function getCity()
	{
		return $this->city;
	}
	public function getComplement()
	{
		return $this->complement;
	}
// _________________


// ________ SETTERS ________
	public funciton setUser(User $user)
	{
		$this->user = $user;
		$this->id_user = $user->getId();
		return true;
	}
	public function setAddress($address)
	{
		if ( strlen($address) <= 511 )
		{
			$this->address = $address;
			return true;
		}
		else
		{
			return "Erreur adresse : 511 caractères maximum.";
		} 
	}
	public function setPostCode($postCode)
	{
		if ( strlen($postCode) <= 9 )
		{
			$this->$post_code = $postCode;
			return true;
		}
		else
		{
			return "Code postal invalide.";
		}
	}
	public function setCity($city)
	{
		if ( strlen($city) <= 127 )
		{
			$this->city = $city;
			return true;
		}
		else
		{
			return "Erreur ville : 127 caractères maximum.";
		}
	}
	public function setComplement($complement)
	{
		if ( strlen($complement) <= 255 )
		{
			$this->complement = $complement;
			return true;
		}
		else
		{
			return "Erreur complément d'adresse : 255 caractères maximum.";
		}
	}
// ________________


}

?>


