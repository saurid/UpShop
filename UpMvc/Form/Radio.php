<?php
/**
 * /UpMvc/Form/Radio.php
 * @package UpMvc2
 */

namespace UpMvc\Form;

use UpMvc\Container as Up;

/**
 * Rendrerar radioknappar
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.10.2
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Radio extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string radioknappar
     */
    public function render()
    {
        return Up::view()
            ->set('field', $this)
            ->render('UpMvc/Form/View/radio.php');
    }
}
