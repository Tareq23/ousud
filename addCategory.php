<?php
require_once 'init/init.php';
if(!Session::get('admin'))
{
    Redirect::to('index.php');
}
if(Input::exists())
{

    if(Token::check(Input::check('token')))
    {
        $validate = new Validate('category');
        $validation = $validate->validation(array(
            'category_name' => array(
                'require' => true,
                'min' => 3,
                'max' => 30,
                'unique' => true
            )
        ));

        if($validate->passed())
        {
            $insert = DB::connect()->insert('category',array(
                'category_name' => Input::check('category_name')
            ));
            if($insert->count())
            {
                echo 'Successfully added';
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
    <h2>Add category page</h2>
</div>

<form action="" method="post">
    <div class="form">
            <label for="category">Category Name</label>
            <input type="text"name="category_name"id="category"placehodler="Category Name">
    </div><br>
    <input type="hidden"name="token"value="<?php echo Token::generate();?>">
    <div class="form">
        <input type="submit" name="add" value="Added">
    </div>

</form>