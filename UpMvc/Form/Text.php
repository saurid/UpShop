<?php
/**
 * /UpMvc/Form/Text.php
 * @package UpMvc2
 */

namespace UpMvc\Form;

/**
 * Rendrerar ett textfält
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.1.1
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
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/text.php');
    }
}
