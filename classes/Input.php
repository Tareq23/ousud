<?php


class Input{
    public static function exists($type = 'post')
    {
        switch($type)
        {
            case 'post':
                return (!empty($_POST))?true:false;
            break;
            case 'get':
                return (!empty($_GET))?true:false;
            break;
            default:
            return false;
        }
    }
    public static function extension($value)
    {
        $extensions = array("jpg","jpeg","png","gif");
        $value = strtolower($value);
        return in_array($value,$extensions)?true:false;
    }
    public static function check($value)
    {
        if(isset($_POST[$value])) return $_POST[$value];
        else if(isset($_GET[$value])) return $_GET[$value];
        return '';
    }
}






