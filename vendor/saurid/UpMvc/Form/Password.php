<?php
/**
 * /UpMvc/Form/Password.php
 * 
 * @package UpMvc2\Form
 */

namespace UpMvc\Form;

use UpMvc\Container as Up;

/**
 * Rendrerar ett passwordfält.
 * 
 * @package UpMvc2\Form
 * @author  Ola Waljefors
 * @version 2013.10.2
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Password extends Base
{
    /**
     * Skapa HTML-uppmärkning.
     * 
     * @return string passwordfält
     */
    public function render()
    {
        return Up::view()
            ->set('field', $this)
            ->render('UpMvc/Form/View/password.php');
    }
}
