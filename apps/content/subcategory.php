<?php
if(isset($_GET['id']))
{
	$subCategoryManager = new SubcategoryManager($database);
	$subCategory = $subCategoryManager->findById($_GET['id']);
	require('views/content/subcategory.phtml');
	
}
?>