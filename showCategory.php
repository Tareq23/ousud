<?php

require_once 'init/init.php';
if(!Session::get('admin'))
{
    Redirect::to('index.php');
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
          <td><a href="showProduct.php?id=<?php echo $category->id;?>"><?php echo $category->category_name ;?></a></td>
        </tr>
      <?php endforeach;?>
  </tbody>
</table>

