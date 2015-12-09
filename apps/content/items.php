<?php
$itemManager = new ItemManager
$listitem = $itemManager->GetByIdSubCategory($_GET['id']);

$i = 0
	while (isset($listitem[$i]))
	{
		$topic = $listitem[$i];
		require('views/content/items.phtml');
	}
?>