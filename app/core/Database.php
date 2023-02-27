<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh, $stmt;

    public function __construct()
    {
        // data source name
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {            
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            $this->dbh->beginTransaction();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
        return $this;
    }

    public function bind($param, $value, $type = null)
    {
        if(is_null($type)) {
            switch(true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default : 
                    $type = PDO::PARAM_STR;
                    break;
            }

            $this->stmt->bindValue($param, $value, $type);            
            return $this;
        }
    }
    
    public function execute()
    {
        $this->stmt->execute();
    }

    public function binds($params = []) {
        foreach($params as $key => $value) {
            $this->bind($key, $value);
        }        
        return $this;
    }

    public function commit()
    {
        $this->dbh->commit();
        return true;
    }

    public function rollBack()
    {
        $this->dbh->rollBack();
        return false;
    }

    public function all()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);            
    }

    public function rowCount()
    {        
        return $this->stmt->rowCount();
    }    
}