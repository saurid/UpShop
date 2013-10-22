<?php
/**
 * /UpMvc/Form/Text.php
 * @package UpMvc2
 */

namespace UpMvc\Form;

use UpMvc\Container as Up;

/**
 * Rendrerar ett textfält
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.10.2
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Text extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string textfält
     */
    public function render()
    {
        return Up::view()
            ->set('field', $this)
            ->render('UpMvc/Form/View/text.php');
    }
}
