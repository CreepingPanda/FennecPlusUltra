<?php
if(isset($_GET['id'])&& $_GET['id'] == $currentUser->getId())
{
    require('views/content/profile.phtml');
}
else
{
    header("Location: ?page=home");
    exit;
}
