<?php
/**
 * /UpMvc/Form/Password.php
 * @package UpMvc2
 */

namespace UpMvc\Form;

/**
 * Rendrerar ett passwordfält
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Password extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string passwordfält
     */
    public function render()
    {
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/password.php');
    }
}
