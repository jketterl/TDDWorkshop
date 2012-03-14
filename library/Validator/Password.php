<?php
namespace Validator;

class Password implements ValidatorInterface
{
    /**
     * Ueberprueft ein Passwort auf Mindestkriterien:
     *  - Kleinbuchstaben
     *  - Grossbuchstaben
     *  - Zahlen
     *  - Mind. 8 Zeichen lang
     *
     * @see Validator.ValidatorInterface::isValid()
     * 
     * @param String $data
     * @return Boolean
     */
    public function isValid($data)
    {
        // Als erstes auf die Laenge pruefen
        $this->checkLength($data);
        // Auf Kleinbuchstaben pruefen
        $this->checkOccurences('/[a-z]+/', $data);
        // Auf Grossbuchstaben pruefen
        $this->checkOccurences('/[A-Z]+/', $data);
        // Auf Zahlen pruefen
        $this->checkOccurences('/[0-9]+/', $data);
        
        return true;
    }
    
    /**
     * Laenge des Passworts pruefen
     
     * @param String $data
     * @throws \InvalidArgumentException
     */
    private function checkLength($data)
    {
        if (strlen($data) < 8) {
            throw new ValidatorException('Zu kurzes Passwort');
        }
    }
    
    /**
     * Passwort auf ein bestimmtes Regex pruefen
     * 
     * @param String $regexPattern
     * @param String $data
     * @throws \InvalidArgumentException
     */
    private function checkOccurences($regexPattern, $data)
    {
        // preg_match liefert die Anzahl der Vorkommnisse eines Patterns
        // Wir erhalten also einen Integer
        if (preg_match($regexPattern, $data, $matches) === 0) {
            throw new ValidatorException('Fehlende Zeichen im Passwort: "' . $regexPattern . '"');
        }
    }
}