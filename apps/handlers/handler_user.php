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
                /*header("Location: index.php");*/
            }
            else
            {
                return $errors;
            }


        }
    }


    elseif($_POST['action'] == "connect")
    {
        if(isset($_POST['email'], $_POST['password']))
        {
            $userManager    = new UserManager($database);
            if ($user = $userManager->findByEmail($_POST['email']))
            {
                return $user;
            }
            else
            {
                throw new Exception('Find by email crash!');
            }
            var_dump($user);
        }
    }

}