<?php

require_once 'init/init.php';


$user = new User();


if(Session::exists('admin')===true)
{
    Session::delete('admin');
    Session::delete(Config::get('session/session_name'));
}
else{
    Session::delete(Config::get('session/session_name'));
}

Redirect::to('index.php');
