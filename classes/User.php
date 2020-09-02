<?php 

class User{

    private $_db=null,$_data=null;
    private $_sessionName=null;
    private $_isLoggedin;
    private $_isAdmin=false;
    public function __construct($user=null)
    {
        $this->_db = DB::connect();
        $this->_sessionName = Config::get('session/session_name');
        if(!$user)
        {
            if(Session::exists($this->_sessionName))
            {
                $user = Session::get($this->_sessionName);
                if($this->find($user))
                {
                    $this->_isLoggedin = true;
            
                }
            }
        }
        else{
            $this->find($user);
        }
    }

    public function create($fields=array())
    {
        if(!$this->_db->insert('customer',$fields))
        {
            throw new Exception('Facing problem to create new account');
        }
    }
    private function find($user=null)
    {
        if($user){
            $field = (is_numeric($user))?'id':'email';
            $data = $this->_db->get('customer',array($field=>$user))->fetch();
            if($data->count())
            {
                $this->_data = $data->result();
                return true;
            }
            $data = $this->_db->get('admin',array($field=>$user))->fetch();
            if($data->count())
            {
                $this->_data = $data;
                $this->_isAdmin = true;
                // 'admin true!';
                return true;
            }
        }
        return false;
    }
    public function login($email,$password)
    {
        $user = $this->find($email);

        if($user)
        {
            if($this->data()->password === Hash::make($password))
            {
                if($this->_isAdmin)
                {
                    Session::put('admin',true);
                    Session::put($this->_sessionName,$this->data()->id);
                }
                else{
                    Session::put($this->_sessionName,$this->data()->id);
                }
                return true;
            }
        }
        return false;
    }
    public function data()
    {
        return $this->_data;
    }

    public function isLoggedIn()
    {
        return $this->_isLoggedin;
    }

    public function logout()
    {
        Session::delete($this->_sessionName);
    }

}






