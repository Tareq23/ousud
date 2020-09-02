<?php

require_once 'init/init.php';


$user = new User();


if(Session::exists('admin')===true)
{
    Session::delete('admin');
}
else{
    session_destroy();
}

Redirect::to('index.php');
