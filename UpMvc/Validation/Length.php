<?php
/**
 * /UpMvc/Validation/Length.php
 * @package UpMvc2
 */

namespace UpMvc\Validation;

/**
 * Validerar längd med min och max
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Validation
 * @version 2013.3.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Length implements Base
{
    /**
     * Konstruktor
     * @param integer $min Minimumlängd
     * @param integer $max Maximumlängd
     * @throws \InvalidArgumentException Om $min inte är en siffra
     * @throws \InvalidArgumentException Om $max inte är en siffra
     * @throws \InvalidArgumentException Om $max inte är större eller lika med $min
     */
    public function __construct($min, $max)
    {
        if (!is_integer($min)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara en siffra (min)', __METHOD__));
        }
        if ($max === null) {
            $max = $min;
        }
        if (!is_integer($max)) {
            throw new \InvalidArgumentException(sprintf('%s: Andra argumentet måste vara en siffra (max)', __METHOD__));
        }
        if ($min > $max) {
            throw new \InvalidArgumentException(sprintf('%s: Andra argumentet (max) måste vara större än, eller lika med första (minimum)', __METHOD__));
        }
        $this->min = $min;
        $this->max = $max;
    }
    
    /**
     * Validera data
     * @param mixed $data Data som ska valideras
     * @return bool true om data uppfyller krav
     */
    public function validate($data)
    {
        $length = strlen(trim($data));
        if ($length < $this->min || $length > $this->max) {
            return false;
        }
        
        return true;
    }
}
