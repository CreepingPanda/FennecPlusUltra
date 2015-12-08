<?php
if(count($errors)>0)
{
    for($i = 0; $i< count($errors); $i++){
        require('views/errors.phtml');
    }
}
if(isset($_SESSION['success']) && $_SESSION['success'] != "")
{
    require('views/success.phtml');
}
require('views/content.phtml');
?>