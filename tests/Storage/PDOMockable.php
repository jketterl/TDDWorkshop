<?php
/**
 * PDO verlangt Parameter Konstruktor. Ruft man den Originalkonstruktor nicht
 * auf beim Mocking, serialisiert phpunit das Objekt zum mocken
 * Serialisieren geht bei PDO nicht. Deswegen verwenden wir diese Hilfsklasse,
 * die lediglich PDO extended und den Konstruktor ueberschreibt 
 *
 * @author djungowski
 *
 */
class PDOMockable extends PDO
{
    public function __construct()
    {
        
    }
}