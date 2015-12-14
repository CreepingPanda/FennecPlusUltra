<?php
	if ( isset($_POST['cardNumber']) )
		$cardNumber = $_POST['cardNumber'];
	else
		$cardNumber = '';

	require('views/content/payment.phtml');
?>