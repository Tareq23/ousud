<?php

require_once 'init/init.php';

if(!Session::exists('admin'))
{
    Redirect::to('index.php');
}

$id = Input::exists('get')?Input::check('id'):'';
if(empty($id)){
    Redirect::to('showProduct.php');
}

$product = DB::connect()->get('product',array('id'=>$id))->fetch()->result();


$cat = DB::connect()->get('category',array('id'=>$product->category_id))->fetch()->result();
$categorys = DB::connect()->getAll('category')->fetchAll()->result();

if(Input::exists())
{
    if(Token::check(Input::check('token')))
    {
        $ext = 'jpg';
        $img_url = "img/".$product->image;
        if(isset($_FILES['image'])){
        $target_file = $_FILES["image"]["name"];
        $ext = explode('.',$target_file);
        // print_r($ext);
        // die();
        $ext = end($ext);
        }

        
        $validate = new Validate('product');
        $validation = $validate->validation(array(
            'product_name' => array(
                'require' => true,
                'min' => 3,
            ),
            'image'=>array(
                'extension' => $ext
            ),
            '_status' => array(
                'require' => true
            ),
            'category' =>array(
                'require' => true,
                'numeric' => true
            ),
            'price' => array(
                'require' => true,
                'numeric' => true,
            ),
            'generic' => array(
                'require' => true,
                'max' => 40,
                'min' => 3
            ),
            'company' => array(
                'require' => true,
                'max' => 40,
                'min' => 3
            ),
            'type' => array(
                'max' => 40,
                'min' => 3
            )
        ));

        if($validate->passed())
        {

            $img_url = "img/".$product->image;

            $image_name = $product->image;

            if($_FILES['image']['error']==0)
            {
                if($image_name!='default.jpg'){
                unset($img_url);
                }
                $image_name = Input::check('product_name').'.'.$ext;
            }


            $insert = DB::connect()->update('product',array('id'=>$product->id),array(
                'product_name' => Input::check('product_name'),
                'price' => Input::check('price'),
                'generic' =>Input::check('generic'),
                'type' => Input::check('type'),
                'category_id'=>Input::check('category'),
                'company'=>Input::check('company'),
                'status' => Input::check('_status'),
                'image' =>$image_name
            ));
            if($insert->count())
            {
                Session::put('product_update_success','Successfully Updated');
                $tmp_name = $_FILES['image']['tmp_name'];
                // echo $tmp_name;
                // die();
                move_uploaded_file($tmp_name,'img/'.$image_name);
            }
        }
        else{
            Session::put('product_update_failed',$validate->error());
        }
    }
    Redirect::to('showProduct.php');
}

?>

<div>
    <h2>Update Product page</h2>
</div>

<form action="" method="post"enctype="multipart/form-data">
    <div class="form">
        <label for="category">Select Category</label>

        <select name="category" id="category">
            <option value="<?php $product->category_id; ?>"><?php echo $cat->category_name;?></option>
            <?php 
                foreach($categorys as $category):
                    ?>
            <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>

        <label for="name">Product name</label>
        <input type="text" name="product_name" id="name" value="<?php echo $product->product_name; ?>">

    </div>
    <br>
    <div class="form">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" value="<?php echo $product->price; ?>" min="0">
    </div><br>
    <div class="form">
        <label for="generic">Generic</label>
        <input type="text" name="generic" id="generic" value="<?php echo $product->generic; ?>">
    </div><br>
    <div class="form">
        <label for="company">Manufacture Company</label>
        <input type="text" name="company" id="company" value="<?php echo $product->company; ?>">
    </div><br>
    <div class="form">
        <label for="type">Product Type</label>
        <input type="text" name="type" id="type" value="<?php echo $product->type; ?>">
    </div><br>
    <div class="form">
        <label for="image">Product Image</label>
        <input type="file" name="image" id="image">
        <img style="width:100px;height:80px;" src="img/<?php echo $product->image; ?>" alt="<?php echo $product->image; ?>">
    </div><br>
    <div class="form">
        <label for="status">Status</label>
        <input type="number" max="2" min="1" name="_status" id="status" value="<?php echo $product->status; ?>">
    </div><br>
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <div><input type="submit" name="update" value="update"></div>

</form>