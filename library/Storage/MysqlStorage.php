<?php
namespace Storage;

class MysqlStorage implements StorageInterface
{
    protected $_table;
    protected $_className;
    protected $_dbHandler;
    
    public function __construct($table, $className)
    {
        $this->_table = $table;
        if (!class_exists($className)) {
            throw new \InvalidArgumentException('class "' . $className . '" does not exist');
        }
        $this->_className = $className;
    }
    
    public function setDbHandler(\PDO $dbHandler)
    {
        $this->_dbHandler = $dbHandler;
    }
    
    /**
     * 
     * @return \PDO
     */
    private function getDbHandler()
    {
        if (!isset($this->_dbHandler)) {
            $this->_dbHandler = new \PDO("mysql:host=localhost;dbname=tddworkshop", "root", "");
            $this->_dbHandler->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->_dbHandler;
    }
    
    public function find($id)
    {
        $query = $this->getDbHandler()->prepare('SELECT * FROM ' . $this->_table . ' WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        // we queried by id, so this basically should only return one set of data.
        $data = $query->fetch();
        return $this->toObject($data);
    }
    
    public function store($object)
    {
        // is this a new object (=> INSERT) or an existing one (=> UPDATE)?
        // i'll let the id decide
        $new = !isset($object->id);
        // building a PDO query, a little bit crude... but should work for demonstration purposes.
        $data = Array();
        foreach ($object as $key => $value) {
            // id is a generated value, don't insert it
            if ($key == 'id') continue;
            $data[$key] = $value;
        }
        if ($new) {
            $columns = array_keys($data);
            $statement = 'INSERT INTO ' . $this->_table . ' (' . implode(', ', $columns) . ') VALUES (';
            
            // quickly rework columns array into pdo placeholder
            foreach ($columns as &$column) $column = ':' . $column;
            $statement .= implode(', ', $columns) . ')';
        } else {
            $updates = Array();
            foreach ($data as $key => $value) $updates[] = $key . ' = :' . $key;
            $statement = 'UPDATE ' . $this->_table . ' SET ' . implode(', ', $updates) . ' WHERE id = :id';
        }
        
        $query = $this->getDbHandler()->prepare($statement);
        
        // bind parameters
        foreach ($data as $key => $value) {
            $query->bindValue(':' . $key, $value);
        }
        
        // also bind the id if this is an update
        if (!$new) $query->bindValue(':id', $object->id);
        
        // and run it!
        $query->execute();
            
        if ($new) {
            // set the id to the last insert id from the db; that way future store statements will not produce inserts
            $object->id = $this->getDbHandler()->lastInsertId();
        }
    }
    
    public function findAll()
    {
        $query = $this->getDbHandler()->prepare('SELECT * FROM ' . $this->_table);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        
        $result = Array();
        while (($row = $query->fetch()) !== FALSE) {
            $result[] = $this->toObject($row);
        }
        return $result;
    }
    
    protected function toObject($data)
    {
        $object = new $this->_className;
        
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }
        
        return $object;
    }
}