<?php

require_once 'init/init.php';
if(!Session::get('admin'))
{
    Redirect::to('index.php');
}
$id = (isset($_GET['id']))?$_GET['id'] : '';
$products='';
if(!empty($id)){
$products = DB::connect()->get('product',array('category_id'=>$id))->fetchAll()->result();
}
else{
    $products = DB::connect()->getAll('product')->fetchAll()->result();
}



if(Session::exists('product_update_success'))
{
  echo Session::get('product_update_success');
  Session::delete('product_update_success');
}
else if(Session::exists('product_update_failed'))
{
  $errors = Session::get('product_update_failed');
  foreach($errors as $error)
  {
    echo $error.'<br>';
  }
  Session::delete('product_update_failed');
}


if(Session::exists('delete_product'))
{
  ?>
    <p><?php echo $_SESSION['delete_product'];
    Session::delete('delete_product'); ?></p>  
  <?php
}
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">product name</th>
      <th scope="col">price</th>
      <th scope="col">company</th>
      <th scope="col">generic</th>
      <th scope="col">type</th>
      <th scope="col">Picture</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($products as $product): ?>
        <tr>  
        <td><?php echo $product->product_name; ?></td>
        <td><span>per pata </span><?php echo $product->price; ?><span> taka</span></td>
        <td><?php echo $product->company; ?></td>
        <td><?php echo $product->generic; ?></td>
        <td><?php echo $product->type; ?></td>
        <td><img style="width:100px;height:auto;" src="img/<?php echo $product->image;?>" alt="product image"></td>
        <td><a href="deleteProduct.php?id=<?php echo $product->id;?>">Delete</a></td>
        <td><a href="updateProduct.php?id=<?php echo $product->id;?>">Update</a></td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>

</body>
</html>
