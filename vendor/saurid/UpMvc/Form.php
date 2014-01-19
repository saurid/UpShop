<?php
/**
 * /UpMvc/Form.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

use UpMvc\Container as Up;

/**
 * Skapa kompletta HTML-formulär.
 * 
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 * 
 * @todo Klassen och dess ingående komponenter är under utveckling!
 */
class Form
{
    /** @type string Formulärets id. */
    private $id = 'UpMvc_Form';
    
    /** @type string Formulärets postmethod. */
    private $method;
    
    /** @type string Formulärets action. */
    private $action;
    
    /** @type array Formulärets fält. */
    private $fields;
    
    /** @type object UpMvc\View-objekt. */
    private $view;
    
    /**
     * Konstruktor.
     * 
     * @param string $method post eller get.
     * @param string $action URL till form action.
     * 
     * @todo Typkontrollera andra argumentet.
     * @throws \InvalidArgumentException Om $method inte är 'post' eller 'get'.
     */
    public function __construct($method = 'post', $action = '')
    {
        if (strtolower($method) != 'post' AND strtolower($method) != 'get') {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara antingen &quot;post&quot; eller &quot;get&quot;', __METHOD__));
        }
        $this->method = $method;
        $this->action = ($action) ? $action : $_SERVER['PHP_SELF'];
    }
    
    /**
     * Skapa ett formulärfält och lagra i $fields.
     * 
     * @param string          $name   Fältets namn.
     * @param UpMvc\Form\Base $object Eller barn till.
     * 
     * @throws \InvalidArgumentException Om $name inte är ett giltigt variabelnamn.
     * @throws \InvalidArgumentException Om $object inte är ett UpMvc\Form\Base-objekt.
     */
    public function __set($name, $object)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $name)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett giltigt variabelnamn', __METHOD__));
        }
        if (!$object instanceof Form\Base) {
            throw new \InvalidArgumentException(sprintf('%s: Andra argumentet måste vara ett objekt av typen UpMvc\Form\Base', __METHOD__));
        }
        $this->fields[$name] = $object;
    }
    
    /**
     * Sätt id på formuläret.
     * 
     * @param string $id Formulärets id.
     * 
     * @throws \InvalidArgumentException Om argumentet inte är ett giltigt variabelnamn.
     */
    public function setId($id)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $id)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett giltigt variabelnamn', __METHOD__));
        }
        $this->id = $id;
    }
    
    /**
     * Hämta fält.
     * 
     * @param string $name Fältets namn.
     * 
     * @return UpMvc\Form\Base
     */
    public function __get($name)
    {
        return $this->fields[$name];
    }
    
    /**
     * Hämta id.
     * 
     * @return string Formulärid.
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Hämta method.
     * 
     * @return string Form method.
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Hämta action.
     * 
     * @return string Form action.
     */
    public function getAction()
    {
        return $this->action;
    }
    
    /**
     * Hämta formulärfält.
     * 
     * @return array fields.
     */
    public function getFields()
    {
        return $this->fields;
    }
    
    /**
     * Skapa det kompletta formuläret.
     * 
     * @return string HTML-kod.
     */
    public function render()
    {
        return Up::view()
            ->set('form', $this)
            ->setPath('vendor/saurid/')
            ->render('UpMvc/Form/View/base.php');
    }
}
