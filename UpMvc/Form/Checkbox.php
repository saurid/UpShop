<?php
/**
 * /UpMvc/Form/Checkbox.php
 * @package UpMvc2
 */

namespace UpMvc\Form;

/**
 * Rendrerar en checkbox
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.1.1
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
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/checkbox.php');
    }
}
