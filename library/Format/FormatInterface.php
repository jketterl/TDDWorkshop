<?php
namespace Format;

interface FormatInterface
{
    /**
     * Dateiendung fuer das entsprechende Format ausgeben, ohne Punkt
     * z.B. json, xml
     * 
     */
    public function getFileExtension();
}