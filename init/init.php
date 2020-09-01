<?php


session_start();

$GLOBALS['config']=array(

    'session' => array(
        'session_name' => 'users',
        'token_name' => 'token'
    ),

);
spl_autoload_register(function($class){
    require_once 'classes/'.$class.'.php';
});

?>

<!doctype html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    </head>
   <body>    


