<?php
/**
 * /UpMvc/RouteResolver.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Tolkar och översätter en router-sträng.
 * 
 * Avgör vilken modul, controller och action som ska köras och om det finns
 * parametrar som argument. UpMvc\Route använder sig av objektet för
 * att köra rätt controller.
 * Routen ska se ut enligt "Modul/Controller/action/parameter1/parameter2/..."
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2013.2.8
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class RouteResolver
{
    /** @type string Standardmodul. */
    private $module = 'App';
    
    /** @type string Standardcontroller. */
    private $controller = 'Index';
    
    /** @type string Standardaction/metod. */
    private $action = 'index';
    
    /** @type string Controllers klassnamn. */
    private $class = '%s\Controller\%s';
    
    /** @type array Parametrar. */
    private $parameters;
    
    /**
     * Konstruktor.
     * 
     * @param string $route Sträng där delarna har / som skiljetecken.
     */
    public function __construct($route = null)
    {
        // Om argument är tomt (eller av fel typ) försök hämta från URL
        if (!$route OR !is_string($route)) {
            $route = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']);
        }
        
        // Dela upp routen i sina beståndsdelar
        $route = explode('/', trim($route, '/'));
        
        // Om första delen är en mapp anses den vara en modul
        if (is_dir($route[0])) {
            $this->module = array_shift($route);
        }
        
        // Om den inte är en modul är delen en controller
        if (!empty($route[0])) {
            $this->controller = array_shift($route);
        }
        
        // Nästa del är en action/metod
        if (!empty($route[0])) {
            $this->action = array_shift($route);
        }
        
        // Skapar controllerns klassnamn
        $this->class = sprintf($this->class, $this->module, $this->controller);

        // Resterande delar i routen är parametrar som skickas
        // med till controllern som argument
        $this->parameters = $route;
    }
    
    /**
     * Hämta modul.
     * 
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }
    
    /**
     * Hämta controller.
     * 
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }
    
    /**
     * Hämta action.
     * 
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
    
    /**
     * Hämta klass.
     * 
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
    
    /**
     * Hämta parametrar.
     * 
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
