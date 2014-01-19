<?php
/**
 * /UpMvc/Validation/Email.php
 * 
 * @package UpMvc2\Validation
 */

namespace UpMvc\Validation;

/**
 * Validerar e-post.
 *
 * @package UpMvc2\Validation
 * @author  Ola Waljefors
 * @version 2013.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Email implements Base
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
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }
}
