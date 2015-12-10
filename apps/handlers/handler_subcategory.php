<?php

if(isset($_POST['action']))
{
    if($_POST['action'] == "add")
    {
        if(isset($_POST['name'], $_POST['category'], $_POST['description'], $_POST['image']))
        {
            $sub_name           = $_POST['name'];
            $sub_id_category    = $_POST['category'];
            $sub_description    = $_POST['description'];
            $sub_image          = $_POST['image'];

            $subcategoryManager = new SubCategoryManager($database);
            $categoryManager    = new CategoryManager($database);
            $category           = $categoryManager->findById($sub_id_category);

            try
            {
                $subcategoryManager->create($sub_name, $sub_description, $sub_image, $category);
            }
            catch(Exception $e)
            {
                $errors[] = $e->getMessage();
            }
            if(count($errors) == 0)
            {
                $_SESSION['success'] = "La sous-categorie a bien été crée";
            }
            else
            {
                $_SESSION['errors'] = $errors;
            }
            header('Location: ?page=admin');
            exit;
        }
    }
}


?>