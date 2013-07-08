<?php
/**
 * /UpMvc/Form/Textarea.php
 * @package UpMvc2
 */

namespace UpMvc\Form;

/**
 * Rendrerar en textarea
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Textarea extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string textarea
     */
    public function render()
    {
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/textarea.php');
    }
}
