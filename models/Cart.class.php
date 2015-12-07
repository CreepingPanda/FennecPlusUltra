<?php

class Cart
{


// ________ PROPRIETES ________
	private $database;
	private $id;

	private $id_user;
	private $user;

	private $id_ad_livraison;
	private $ad_livraison;

	private $id_ad_facturation;
	private $ad_facturation;

	private $id_payment_mode;
	private $payment_mode;

	private $id_shipping_mode;
	private $shipping_mode;

	private $status;
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
	public function getUser()
	{
		if ( !$this->user )
		{
			$manager = new UserManager($this->database);
			$this->user = $manager->findById($this->id_user);
		}
		return $this->user;
	}
	public function getAdLivraison()
	{
		if ( !$this->ad_livraison )
		{
			$manager = new Ad_livraisonManager($this->database)
			$this->ad_livraison = $manager->findById($this->id_ad_livraison);
		}
		return $this->ad_livraison;
	}
	public function getAdFacturation()
	{
		if ( !$this->ad_facturation )
		{
			$manager = new Ad_facturationManager($this->database)
			$this->ad_facturation = $manager->findById($this->id_ad_facturation);
		}
		return $this->ad_facturation;
	}
	public function getPaymentMode()
	{
		if ( !$this->payment_mode )
		{
			$manager = new Payment_modeManager($this->database);
			$this->payment_mode = $manager->findById($this->id_payment_mode);
		}
		return $this->payment_mode;
	}
	public function getShippingMode()
	{
		if ( !$this->shipping_mode )
		{
			$manager = new Shipping_modeManager($this->database);
			$this->shipping_mode = $manager->findById($this->id_shipping_mode);
		}
		return $this->shipping_mode;
	}
	public function getStatus()
	{
		return $this->status;
	}
// ________________


// ________ SETTERS ________










?>