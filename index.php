<?php
	
// ________ TOOLS ________
	session_start();

	try
	{
//		$database = new PDO("mysql:host=192.168.1.23;dbname=fenneccommerce", "fennec", "fennec");
		$database = new PDO("mysql:host=localhost;dbname=fenneccommerce", "root", "");
	}
	catch (Exception $e)
	{
		// ____ Message dev :
		die("Erreur : ".$e->getMessage());
		// ____ Message prod :
		// die(var_dump("Le con de stagiaire a debranche la base de donnees."));
	}
$errors = array();

	spl_autoload_register(function ($class)
	{
		require('models/'.$class.'.class.php');
	});

	if ( isset($_SESSION['id']) )
	{
		$userManager = new UserManager($database);
		$currentUser = $userManager->getCurrent();
	}

// ________ HUB ________
	$ways = array(
		'admin',
		'home', 'category', 'subcategory', 'item',
		'cart', 'address', 'payment',
		'register', 'login', 'profile', 'edit_profile');
	$handlers = array(
		'create_item'=>'item', 'create_category'=>'category', 'create_subcategory'=>'subcategory',
		'create_shipping_mode'=>'shipping_mode',
		'register'=>'user', 'login'=>'user', 'logout'=>'user', 'edit_profile'=>'user',
		'category'=>'category',
		'subcategory'=>'subcategory',
		'item'=>'item', 'add_to_cart'=>'cart',
		'cart'=>'cart', 'address'=>'cart', 'payment'=>'cart');

	$page = 'home';

	if ( isset($_GET['page']) )
	{
		if ( isset($handlers[$_GET['page']]) )
		{
			require('apps/handlers/handler_'.$handlers[$_GET['page']].'.php');
		}
		else if ( in_array($_GET['page'], $handlers) )
		{
			require('apps/handlers/handler_'.$_GET['page'].'.php');
		}
		if ( in_array($_GET['page'], $ways) )
		{
			$page = $_GET['page'];
		}
	}

	require('apps/skel.php');


	$_SESSION['success'] = "";
?>