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
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">product name</th>
      <th scope="col">price</th>
      <th scope="col">company</th>
      <th scope="col">generic</th>
      <th scope="col">type</th>
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
        </tr>
    <?php endforeach;?>
  </tbody>
</table>

</body>
</html>
