<?php

if(isset($_POST['action']))
{
    if($_POST['action'] == "add")
    {
        if(isset($_POST['name'], $_POST['description']))
        {
            $category_name = $_POST['name'];
            $category_description = $_POST['description'];

            $categoryManager    = new CategoryManager($database);

            try
            {
                $categoryManager->create($currentUser, $category_name, $category_description);
            }
            catch(Exception $e)
            {
                $_SESSION['errors'] = $e->getMessage();
            }
            if(!isset($_SESSION['errors']) || $_SESSION['errors'] == "")
            {
                $_SESSION['success']    = "Category a bien été crée";
            }
            header('Location: ?page=admin');
            exit;




        }
    }
}