<?php
if(isset($_POST['action']))
{
    if($_POST['action'] == "register")
    {
        if(isset($_POST['f-name'], $_POST['l-name'], $_POST['email'], $_POST['emailRepeat'], $_POST['password'], $_POST['passwordRepeat']))
        {

            $lastname       = $_POST['l-name'];
            $firstname      = $_POST['f-name'];
            $email          = $_POST['email'];
            $emailRepeat    = $_POST['emailRepeat'];

            $userManager = new UserManager($database);

            try
            {
                $data = $userManager->create($_POST['l-name'], $_POST['f-name'], $_POST['password'], $_POST['passwordRepeat'], $_POST['email'], $_POST['emailRepeat']);
            }
            catch(Exception $e)
            {
                $errors[] = $e->getMessage();
            }
            if(count($errors) == 0)
            {
                $_SESSION['success'] = "Votre inscription est réussite!";
                $_SESSION['id']      = $data->getId();
                header("Location: index.php");
                exit;
            }
            else
            {
                return $errors;
            }


        }
    }


    else if($_POST['action'] == "connect")
    {
        if(isset($_POST['email'], $_POST['password']))
        {
            $email = $_POST['email'];
            $userManager    = new UserManager($database);
            try
            {
                $user = $userManager->findByEmail($_POST['email']);
            }
            catch(Exception $e)
            {
                $errors[] = $e->getMessage();
            }
            try
            {
                $user->verifPassword($_POST['password']);
            }
            catch(Exception $e)
            {
                $errors[] = $e->getMessage();
            }
            if(count($errors) == 0)
            {
                $_SESSION['id'] = $user->getId();
                $_SESSION['success'] = "Bienvenue ".htmlentities($user->getFirstName()).", :)";
                header('Location: index.php');
                exit;
            }
            else
            {
                return $errors;
                var_dump($errors);
            }
        }
    }

} 
else if (isset($_GET['action']) && $_GET['action'] == "logout")
{
    session_destroy();
    $_SESSION = array();
    header('Location: index.php');
    exit;
}