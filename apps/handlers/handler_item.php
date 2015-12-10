<?php

if(isset($_POST['action']))
{
    if($_POST['action'] ==  "add")
    {
        if(isset($_POST['name'], $_POST['category'], $_POST['short_descr'], $_POST['image'], $_POST['description'], $_POST['price'], $_POST['stock']))
        {
            $id_category        = intval($_POST['category']);
            $itemManager        = new ItemManager($database);
            $subcategoryManager = new SubcategoryManager($database);
            $subcategory        = $subcategoryManager->findById($id_category);
            $photo_itemManager = new Photo_itemManager($database);


            try
            {
                $item = $itemManager->create($subcategory, $_POST['name'], $_POST['description'], $_POST['short_descr'], $_POST['price'], $_POST['stock']);
            }
            catch(Exception $e)
            {
                $_SESSION['errors'] = $e->getMessage();
            }

            if(!isset($_SESSION['errors']) || $_SESSION['errors'] == "" )
            {

                try
                {
                    $photo = $photo_itemManager->add($item, $currentUser, $_POST['image']);
                }
                catch(Exception $e)
                {
                    $itemManager->delete($item);
                    $_SESSION['errors'] = $e->getMessage();
                }
                if(!isset($_SESSION['errors']) || $_SESSION['errors'] == "")
                {
                    $_SESSION['success']    = "Produit a bien  été :)";
                    header('Location: ?page=item&id='.$item->getId().'');
                }
            }
        }

    }

}