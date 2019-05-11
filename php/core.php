<?php
    ob_start();
    session_start();
    date_default_timezone_set('Europe/Sofia');
    
    require_once('connection.php');
    require_once('class.php');
    require_once('functions.php');
    
    
    
    $NavigationItems = fetchData('pages', false, '', 99);
    
    
    $UserData = getUserData();
    
    
    