<?php
/**
 * /UpMvc/Form/Checkbox.php
 * @package UpMvc2
 */

namespace UpMvc\Form;

use UpMvc\Container as Up;

/**
 * Rendrerar en checkbox
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.10.2
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Checkbox extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string checkbox
     */
    public function render()
    {
        return Up::view()
            ->set('field', $this)
            ->render('UpMvc/Form/View/checkbox.php');
    }
}
