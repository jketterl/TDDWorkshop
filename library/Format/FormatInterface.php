<?php
namespace Format;

use Json\CodecInterface;

interface FormatInterface extends CodecInterface
{
    /**
     * Dateiendung fuer das entsprechende Format ausgeben, ohne Punkt
     * z.B. json, xml
     * 
     */
    public function getFileExtension();
}