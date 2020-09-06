<?php

require_once 'init/init.php';

if(!Session::exists('admin'))
{
    Redirect::to('index.php');
}

$id = (isset($_GET['id']))?$_GET['id'] : '';

$delete = DB::connect()->delete('product',array('id'=>$id));
if($delete->count())
{
    Session::put('delete_product','Successfully deleted');
}

Redirect::to('showProduct.php');