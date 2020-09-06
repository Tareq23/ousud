<?php

class DB{
    private static $_connect=null;
    private $_pdo=null,$_count=0,$_error=false,$_result=null,$_stmt;
    public function __construct()
    {
        try{
        $this->_pdo = new PDO('mysql:host=localhost;dbname=ousud','root','');
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }
    public static function connect()
    {
        if(self::$_connect == null)
        {
            self::$_connect = new DB();
        }
        return self::$_connect;
    } 
    private function query($sql,$fields = array())
    {
        $this->_error=false;
        if($this->_stmt = $this->_pdo->prepare($sql))
        {
            if(count($fields)){
                $cnt = 1;
                foreach($fields as $field)
                {
                    $this->_stmt->bindValue($cnt,$field);
                    $cnt++;
                }
            }
            if($this->_stmt->execute())
            {
                $this->_count = $this->_stmt->rowCount();
            }
            else{
                $this->_error = true;
            }
        }
        return $this;

    }
    public function fetch()
    {
         $this->_result = $this->_stmt->fetch(PDO::FETCH_OBJ);
         return $this;
    }
    public function fetchAll()
    {
         $this->_result = $this->_stmt->fetchAll(PDO::FETCH_OBJ);
         return $this; 
    }

    public function error()
    {
        return $this->_error;
    }
    public function count()
    {
        return $this->_count;
    }
    public function result()
    {
        return $this->_result;
    }
    public function insert($table,$fields=array())
    {
        if(count($fields))
        {
            $columns = '';
            $cnt=1;
            $value='';
            foreach($fields as $key => $field)
            {
                $columns .= $key;
                $value .= '?';
                if($cnt<count($fields))
                {
                    $columns .= ',';
                    $value .=',';
                }
                $cnt++;
            }
            $sql = "INSERT INTO {$table}({$columns})VALUES({$value})";
            return $this->query($sql,$fields);
        }
        return false;
    }

    public function delete($table,$fields=array())
    {
        if(count($fields)===1)
        {
           $key = array_keys($fields);
           $sql = "DELETE FROM {$table} WHERE {$key[0]} = ?";
           return $this->query($sql,$fields);
        }
        return false;
    }
    private function checkOperator($operator)
    {
        $operators = array('=','>=','<=','<','>');
        if(in_array($operator,$operators)) return true;
        return false;
    }
    public function update($table,$where=array(),$fields=array())
    {
        if(count($fields))
        {
            $columns = '';
            $cnt=1;
            foreach($fields as $key => $field)
            {
                $columns .= "{$key} = ?";
                if($cnt<count($fields))
                {
                    $columns .=', ';
                }
                $cnt++;
            }
            $keys = array_keys($where);
            $sql = "UPDATE  {$table} SET {$columns} WHERE {$keys[0]} = {$where[$keys[0]]}";
            return $this->query($sql,$fields);
        }
    }
    public function get($table,$fields=array())
    {
        if(count($fields))
        {
            //var_dump($fields);
            //die();
            $key = array_keys($fields);
            $sql = "SELECT * FROM {$table} WHERE {$key[0]} = ?";
            return $this->query($sql,$fields);
        }
    }
    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        return $this->query($sql,array());
    }
}





