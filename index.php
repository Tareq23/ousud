<?php

require_once 'init/init.php';

if(Session::exists('home'))
{
    //echo $_SESSION['home'].'<br>';

}

$user = new User();

if($user->isLoggedIn())
{
    ?>
    <ul>
        <li><a href="logout.php">logout</a></li>
        <?php if(Session::exists('admin')){
            ?>
        <li><a href="dashboard.php">Dashboard</a></li>
            <?php
        }
        ?>
    </ul>
<?php
}
else
{
    ?>
    <div>
        <p>You need to<a href="login.php">login</a> or <a href="register.php">register</a></p>
    </div>
<?php
}
$categories = DB::connect()->getAll('category')->fetchAll()->result();
?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Category</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($categories as $category): ?>
        <tr>
          <td><a href="index.php?id=<?php echo $category->id;?>"><?php echo $category->category_name ;?></a></td>
        </tr>
      <?php endforeach;?>
  </tbody>
</table>

<?php

$id = (isset($_GET['id']))?$_GET['id'] : '';

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



