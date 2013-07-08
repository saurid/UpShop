<?php
/**
 * /UpMvc/Validation/Base.php
 * @package UpMvc2
 */

namespace UpMvc\Validation;

/**
 * Interface för valideringsklasser
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Validation
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
interface Base
{
    /**
     * Validera data
     * @param mixed $data Data som ska valideras
     * @return bool true om data uppfyller krav
     */
    public function validate($data);
}
