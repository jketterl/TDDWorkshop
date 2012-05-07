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
    private $_users = array();
    
    public function __construct($usersFile)
    {
        if (!file_exists($usersFile)) {
            throw new \InvalidArgumentException('Usersfile does not exist');
        }
        $this->_usersFile = $usersFile;
    }
    
    private function read()
    {
        $users = file_get_contents($this->_usersFile);
    }
    
    public function getAll()
    {
        $this->read();
    }
}