<?php

    require_once 'init/init.php';
    if(!Session::get('admin'))
    {
        Redirect::to('index.php');
    }
?>

<ul>
    <li><a href="addProduct.php">Add Product</a></li>
    <li><a href="addCategory.php">Add Category</a></li>
    <li><a href="showCategory.php">Show Category</a></li>
    <li><a href="showProduct.php">Show All Product</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>