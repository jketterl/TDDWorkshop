<?php
namespace Validator;

class Password implements ValidatorInterface
{
    public function isValid($data)
    {
        try {
            // Als erstes auf die Laenge pruefen
            $this->checkLength($data);
            // Auf Kleinbuchstaben pruefen
            $this->checkOccurences('/[a-z]+/', $data);
            // Auf Grossbuchstaben pruefen
            $this->checkOccurences('/[A-Z]+/', $data);
            // Auf Zahlen pruefen
            $this->checkOccurences('/[0-9]+/', $data);
        } catch (\InvalidArgumentException $e) {
            return false;
        }
        
        return true;
    }
    
    private function checkLength($data)
    {
        if (strlen($data) < 8) {
            throw new \InvalidArgumentException('Zu kurzes Passwort');
        }
    }
    
    private function checkOccurences($regexPattern, $data)
    {
        // preg_match liefert die Anzahl der Vorkommnisse eines Patterns
        // Wir erhalten also einen Integer
        if (preg_match($regexPattern, $data, $matches) === 0) {
            throw new \InvalidArgumentException('Fehlende Zeichen im Passwort: "' . $regexPattern . '"');
        }
    }
}