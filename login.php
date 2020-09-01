<?php 
require_once 'init/init.php';


if(Input::exists())
{
    if(Token::check(Input::check('token'))){
        $validate = new Validate();
        $validation = $validate->validation(array(
            'email' => array('require'=>true),
            'password' => array('require'=>true)
        ));
        
        if($validate->passed()){
            $user = new User();
            $login = $user->login(Input::check('email'),Input::check('password'));
            if($login)
            {
                Redirect::to('index.php');
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


<form action="" method="post">

    <div>
        <label for="email">Email</label>
        <input type="email"name="email"id="email"placeholder="Your Email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password"name="password"id="password">
    </div>
    <div>
        <label for="remember">
            <input type="checkbox">Remember me
        </label>
    </div>
    <input type="hidden"name="token"value="<?php echo Token::generate();?>">
    <div>
        <input type="submit"name="login"value="login">
    </div>

</form>


