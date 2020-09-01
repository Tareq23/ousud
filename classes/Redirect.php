<?php

class Redirect{
    public static function to($location = null)
    {
        if($location)
        {
            if(is_numeric($location)){
                switch($location)
                {
                    case '404':
                        include 'errors/404.php';
                    break;
                }
            }
            header('location: '.$location);
            exit();
        }
    }
}