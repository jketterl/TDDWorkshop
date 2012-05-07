<?php
namespace Admin;

class UserList
{
    /**
     * Datei, in der sich die Benutzer befinden
     * 
     * @var String
     */
    private $_usersFile;
    
    /**
     * Liste der Benutzer
     * Einzelne Elemente sind vom Typ Admin\User
     * 
     * @var Array
     */
    private $_users;
    
    public function __construct($usersFile)
    {
        if (!file_exists($usersFile)) {
            throw new \InvalidArgumentException('Usersfile does not exist');
        }
        $this->_usersFile = $usersFile;
    }
    
    private function read()
    {
        if (!isset($this->_users)) {
            $this->_users = array();
            $file = fopen($this->_usersFile, 'r');
            
            $key = 0;
            while (($line = fgetcsv($file, 0, ';', '"')) !== FALSE) {
                array_unshift($line, $key++);
                $user = new User();
                $user->load($line);
                $this->_users[] = $user;
            }
        }
    }
    
    public function getAll()
    {
        $this->read();
        return $this->_users;
    }
    
    public function getById($id)
    {
        $this->read();
        if (!isset($this->_users[$id])) {
            throw new \OutOfBoundsException("User doesn't exist");
        }
        return $this->_users[$id];
    }
}