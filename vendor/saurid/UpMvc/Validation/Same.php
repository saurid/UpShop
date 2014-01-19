<?php
/**
 * /UpMvc/Validation/Same.php
 * 
 * @package UpMvc2\Validation
 */

namespace UpMvc\Validation;

/**
 * Validerar om två värden är lika.
 *
 * @package UpMvc2\Validation
 * @author  Ola Waljefors
 * @version 2013.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Same implements Base
{
    /**
     * Konstruktor.
     * 
     * @param mixed $one Första värdet.
     * @param mixed $two Andra värdet.
     */
    public function __construct($one, $two)
    {
        $this->one = $one;
        $this->two = $two;
    }
    
    /**
     * Validera data.
     * 
     * @param mixed $data Data som ska valideras.
     * 
     * @return bool true om data uppfyller krav.
     */
    public function validate($data = null)
    {
        if ($this->one != $this->two) {
            return false;
        }
        
        return true;
    }
}
