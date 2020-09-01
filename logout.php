<?php

require_once 'init/init.php';


$user = new User();


if(Session::exists('admin')===true)
{
    Session::delete('admin');
}

Redirect::to('index.php');
