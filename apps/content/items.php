<?php
$itemManager = new ItemManager
$listitem = $itemManager->GetBySubCategory($_GET['id']);

$i = 0
	while (isset($listitem[$i]))
	{
		$topic = $listitem[$i];
		require('views/content/items.phtml');
	}
?>