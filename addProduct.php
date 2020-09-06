<?php

require_once 'init/init.php';
if(!Session::get('admin'))
{
    Redirect::to('index.php');
}

$categorys = DB::connect()->getAll('category')->fetchAll()->result();

if(Input::exists())
{
    if(Token::check(Input::check('token')))
    {
        // $image = $_FILES['image'];
        $target_file = $_FILES['image']['name'];

        $ext = explode('.',$target_file);
        $ext = end($ext);
        $image_name = Input::check('product_name').'.'.$ext;
        $tmp_name = $_FILES['image']['tmp_name'];

        $validate = new Validate('product');
        $validation = $validate->validation(array(
            'product_name' => array(
                'require' => true,
                'min' => 3,
                'unique' => true
            ),
            'image'=>array(
                'require' => true,
                'extension' => $ext
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
            $insert = DB::connect()->insert('product',array(
                'product_name' => Input::check('product_name'),
                'price' => Input::check('price'),
                'generic' =>Input::check('generic'),
                'type' => Input::check('type'),
                'category_id'=>Input::check('category'),
                'company'=>Input::check('company'),
                'image' => $image_name
            ));
            if($insert->count())
            {
                move_uploaded_file($tmp_name,'img/'.$image_name);
                echo 'Successfully Inserted!';
            }
            else{
                echo 'Somthing missing or wrong!';
            }
        }
        else{
            foreach($validate->error() as $error)
            {
                echo $error.'<br>';
            }
        }

    }

}


?>

<div>
    <h2>Add Product page</h2>
</div>

<form action=""method="post" enctype="multipart/form-data">
    <div class="form">
        <label for="category">Select Category</label>

        <select name="category"id="category">
            <option value="">Select</option>
            <?php 
                foreach($categorys as $category):
                    ?>
            <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
                <?php endforeach; ?>
        </select> 
    </div>
    <div>
    
        <label for="name">Product name</label>
        <input type="text" name="product_name"id="name"placehodler="product name">
    
    </div>
    <br>
    <div class="form">
            <label for="price">Price</label>
            <input type="number"name="price"id="price"placehodler="product price"min="0">
    </div><br>
    <div class="form">
            <label for="generic">Generic</label>
            <input type="text"name="generic"id="generic"placehodler="generic Name">
    </div><br>
    <div class="form">
            <label for="company">Manufacture Company</label>
            <input type="text"name="company"id="company"placehodler="Manufacture Company">
    </div><br>
    <div class="form">
            <label for="type">Product Type</label>
            <input type="text"name="type"id="type"placehodler="product type">
    </div><br>
    <div class="form">
            <label for="image">Product Image</label>
            <input type="file"name="image"id="image">
    </div><br>
    <div class="form">
            <label for="status">Status</label>
            <input type="number"max="1"min="0"name="name"id="status"placehodler="Your Name">
    </div><br>
    <input type="hidden"name="token"value="<?php echo Token::generate();?>">
    <div><input type="submit" name="add" value="Added"></div>

</form>