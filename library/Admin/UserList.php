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
        $this->_users = array();
        $file = fopen($this->_usersFile, 'r');

        while (($line = fgetcsv($file, 0, ';', '"')) !== FALSE) {
            $user = new User();
            $user->load($line);
            $this->_users[] = $user;
        }
    }
    
    public function getAll()
    {
        if (!isset($this->_users)) {
            $this->read();
        }
        return $this->_users;
    }
}