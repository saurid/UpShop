<?php
/**
 * /UpMvc/Form/SelectMultiple.php
 * 
 * @package UpMvc2\Form
 */

namespace UpMvc\Form;

use UpMvc\Container as Up;

/**
 * Rendrerar ett selectfält med multipla val.
 * 
 * @package UpMvc2\Form
 * @author  Ola Waljefors
 * @version 2013.10.2
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class SelectMultiple extends Base
{
    /**
     * Skapa HTML-uppmärkning.
     * 
     * @return string multiple select
     */
    public function render()
    {
        return Up::view()
            ->set('field', $this)
            ->render('UpMvc/Form/View/selectmultiple.php');
    }
}
