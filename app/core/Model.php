<?php
 
class Model {
    // protected $table;
    protected $db;
    // private $selectColumn = '';
    // private $queries = '';

    public function __construct()
    {
        $this->db = new Database();
    }        

    // public function select($column = '*')
    // {
    //     $this->selectColumn = $column;
    //     return $this;
    // }
    
    // public function all()
    // {        
    //     return $this->db->query("SELECT $this->selectColumn FROM $this->table $this->queries")->resultAll();        
    // }

    // public function first()
    // {        
    //     return $this->db->query("SELECT $this->selectColumn FROM $this->table $this->queries")->resultSingle();        
    // }

    // public function find($id)
    // {
    //     return $this->db->query("SELECT * FROM $this->table WHERE id=:id")
    //                     ->bind('id', $id)
    //                     ->resultSingle();
    // }

    // public function join($table, $fkey, $pkey, $type = 'INNER')
    // {
    //     $this->queries .= " $type JOIN $table ON $fkey = $pkey ";
    //     return $this;
    // }

    // public function groupBy($column)
    // {
    //     $this->queries .= " GROUP BY $column ";
    //     return $this;
    // }

    // public function latest($column = 'id')
    // {
    //     $this->queries .= " ORDER BY $column DESC ";
    //     return $this;
    // }

    // public function where($column, $val, $type = '')
    // {
    //     $this->queries .= " WHERE $type $column = :$column ";
    //     return $this;
    // }

    // public function andWhere($column, $val)
    // {
    //     $this->queries .= " AND $column = :$column ";
    //     return $this;
    // }

    // public function orWhere($column, $val)
    // {
    //     $this->queries .= " OR $column = :$column ";
    //     return $this;
    // }
}