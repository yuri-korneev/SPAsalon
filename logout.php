<?php

require __DIR__ . '/process.php';

if (null !== getCurrentUser()) {  
    setcookie('login', "", time());
    setcookie('password', "", time());
}

header('Location: /login.php');

?>