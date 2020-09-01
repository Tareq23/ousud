<?php

require_once 'init/init.php';

if(Input::exists())
{
    if(Token::check(Input::check('token'))){
        $validate = new Validate('customer');
        $validation = $validate->validation(array(
            'customer_name' => array(
                'require' => true,
                'max' => 40,
                'min' => 3
            ),
            'email' =>array(
                'require' => true,
                'max' => 80,
                'unique' => true
            ),
            'password' => array(
                'require' => true,
                'max' => 20,
                'min' =>6
            ),
            'confirm_password' => array(
                'require' => true,
                'match' => 'password'
            )
        ));
        
        if($validate->passed())
        {
            $user = new User();
            try{
                $user->create(array(
                    'customer_name' =>Input::check('customer_name'),
                    'password' =>Hash::make(Input::check('password')),
                    'phone' =>Input::check('phone'),
                    'email' => Input::check('email'),
                    'password' => Hash::make(Input::check('password'))
                ));
                Redirect::to('index.php');
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
        else{
            $errors = $validate->error();
            foreach($errors as $key => $error )
            {
                echo $key.'----------'.$error.'<br>';
            }
        }
    }
}

?>

<form action=""method="post">

    <div class="form">
        <label for="username">Name</label>
        <input type="text"name="customer_name"id="username"placehodler="Your Name">
    </div>
    
    <div class="form">
        <label for="email">Email</label>
        <input type="email"name="email"id="email"placehodler="Your Email">
    </div>
    
    
    <div class="form">
        <label for="password">Password</label>
        <input type="password"name="password"id="password">
    </div>
    
    <div class="form">
        <label for="confirm_password">Confirm Password</label>
        <input type="password"name="confirm_password"id="confirm_password">
    </div>
    <div>
        <input type="hidden"name="token"value="<?php echo Token::generate();?>">
    </div>
    <div>
        <input type="submit"value="register"name="register">
    </div>


</form>


