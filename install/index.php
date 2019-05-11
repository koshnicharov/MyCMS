<?php
    require_once('../php/core.php');
    
    
    $query = "DROP TABLE users";
    mysqli_query($db, $query);
    $query = "CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    email TEXT,
    password TEXT,
    phone TEXT,
    username TEXT,
    question TEXT,
    answer TEXT,
    fullname TEXT,
    gender TEXT,
    birthdate TEXT,
    registerdate TEXT
    )";
    mysqli_query($db, $query);
    
    
    $query = "DROP TABLE administration";
    mysqli_query($db, $query);
    $query = "CREATE TABLE administration (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    uid INT(11),
    date DATE
    )";
    mysqli_query($db, $query);
    $queryString = "INSERT INTO administration
    (uid, date) VALUES ('1', NOW())";
    mysqli_query($db, $queryString);
    
    
    $query = "DROP TABLE recover";
    mysqli_query($db, $query);
    $query = "CREATE TABLE recover (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    uid INT(11),
    url TEXT,
    date TEXT
    )";
    mysqli_query($db, $query);
    
    
    $query = "DROP TABLE blog";
    mysqli_query($db, $query);
    $query = "CREATE TABLE blog (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    uid INT(11),
    title TEXT,
    content TEXT,
    publishdate DATETIME,
    editdate DATETIME
    )";
    mysqli_query($db, $query);
    
    
    $query = "DROP TABLE pages";
    mysqli_query($db, $query);
    $query = "CREATE TABLE pages (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    uid INT(11),
    title TEXT,
    content TEXT,
    publishdate DATETIME,
    editdate DATETIME
    )";
    mysqli_query($db, $query);
    
    
    refresh('../index.php');
?>