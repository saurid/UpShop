<?php
/**
 * /UpMvc/Form/SelectMultiple.php
 * @package UpMvc2
 */

namespace UpMvc\Form;

/**
 * Rendrerar ett selectfält med multipla val
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class SelectMultiple extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string multiple select
     */
    public function render()
    {
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/selectmultiple.php');
    }
}
