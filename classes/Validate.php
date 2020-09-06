7<?php

class Validate{

    private $_error=array();
    private $_db=null;
    private $_table=null;
    public function __construct($table=null)
    {
        if($table){
            $this->_table=$table;
        }
        $this->_db =  DB::connect();
    }
    public function validation($posts = array())
    {
        foreach($posts as $item => $rules)
        {
            foreach($rules as $rule=>$value)
            {

                if($item==='image'&&$value=='require')
                {
                    $this->_error[$item] = "{$item} must be required";
                }
                else if(($rule=='require')&&(empty(Input::check($item))))
                {
                    $this->_error[$item] = "{$item} must be required";
                }
                else
                {
                    switch($rule)
                    {
                        case 'fixed':
                            if(strlen($item)!=$value)
                            {
                                $this->_error[$item] = "{$item} must be {$value} characters!";
                            }
                        break;
                        case 'min':
                            if(strlen($item)<$value){
                                $this->_error[$item] = "{$item} must be greater than {$value} characters!";
                            }
                        break;
                        case 'max':
                            
                            if(strlen($item)>$value){
                                $this->_error[$item] = "{$item} must be less than {$value} characters!";
                            }
                        break;
                        case 'match':
                            if(Input::check($item)!==Input::check($value))
                            {
                                $this->_error[$item] = "{$item} must be matched {$value}";
                            }
                        break;
                        case 'unique':
                            if(!$this->_table)
                            {
                                $this->_table='customer';
                            }
                            $res = $this->_db->get($this->_table,array("{$item}"=>Input::check($item)))->fetch();
                            if($res->count())
                            {
                                $this->_error[$item] = "This {$item} already exists";
                            }
                        break;
                        case 'extension':
                             if(!Input::extension($value))
                             {
                                $this->_error[$image] = "This {$item} must be jpg,png or gif type";
                             }
                        break;
                    }
                }
            }
        }
    }
    public function error()
    {
        return $this->_error;
    }
    public function passed()
    {
        if(!count($this->_error)) return true;
        return false;
    }
}