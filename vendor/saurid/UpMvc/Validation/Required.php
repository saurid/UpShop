<?php
/**
 * /UpMvc/Validation/Required.php
 * 
 * @package UpMvc2\Validation
 */

namespace UpMvc\Validation;

/**
 * Validerar om obligatoriskt värde är satt.
 *
 * @package UpMvc2\Validation
 * @author  Ola Waljefors
 * @version 2013.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Required implements Base
{
    /**
     * Validera data.
     * 
     * @param mixed $data Data som ska valideras.
     * 
     * @return bool true om data uppfyller krav.
     */
    public function validate($data)
    {
        if ($data == '') {
            return false;
        }
        
        return true;
    }
}
