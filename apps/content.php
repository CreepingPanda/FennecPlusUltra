<?php
if(count($errors)>0)
{
    for($i = 0; $i< count($errors); $i++){
        require('views/errors.phtml');
    }
}
elseif(isset($_SESSION['errors']) && $_SESSION['errors'] != "")
{
    require('views/errors_session.phtml');
}
elseif(isset($_SESSION['success']) && $_SESSION['success'] != "")
{
    require('views/success.phtml');
}
require('views/content.phtml');
?>