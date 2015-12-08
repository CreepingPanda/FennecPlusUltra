<?php

if(isset($_POST['action']))
{
    if($_POST['action'] ==  "add")
    {
        if(isset($_POST['name'], $_POST['category'], $_POST['short_descr'], $_POST['description'], $_POST['price'], $_POST['stock']))
        {
            $id_category  = intval($_POST['category']);
            $itemManager        = new ItemManager($database);
            $subcategoryManager = new SubcategoryManager($database);
            $subcategory        = $subcategoryManager->findById($id_category);
            var_dump($subcategory);
            try
            {
                $itemManager->create($subcategory, $_POST['name'], $_POST['description'], $_POST['short_descr'], $_POST['price'], $_POST['stock']);

            }
            catch(Exception $e)
            {
                $_SESSION['errors'] = $e->getMessage();
            }
            if(!isset($_SESSION['errors']) || $_SESSION['errors'] == "" )
            {
                $_SESSION['success']    = "Produit a bien  été :)";
            }


        }

    }

}