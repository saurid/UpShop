<?php
/**
 * /UpMvc/Error.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Klass för att lagra felmeddelanden.
 * 
 * Klassen följer designmönstret "singleton" som gör att bara ett objekt av
 * samma typ kan finnas i systemet. Returnerar en tom sträng om variabeln inte
 * är satt för att enkelt undvika felmeddelanden.
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2013.3.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Error
{
    /** @type string HTML-kod för felmeddelande med placeholder. */
    private $html = '<span class="UpMvc_Error">%s</span>';
    
    /** @type array Felmeddelanden. */
    private $errors;
    
    /** @type object Lagrar instans av klassen. */
    private static $instance;
    
    /**
     * Skapa och returnera en instans av denna klassen.
     * 
     * @return UpMvc\Error
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    /**
     * Lagra ett nytt felmeddelande.
     * 
     * @param string $key   Variablens namn.
     * @param mixed  $value Variablens innehåll.
     * 
     * @throws \InvalidArgumentException Om nyckeln inte är ett giltigt variabelnamn.
     * @return UpMvc\Error
     */
    public function set($key, $value)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $key)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett giltigt variabelnamn', __METHOD__));
        }
        $this->errors[$key] = $value;
        
        return $this;
    }
    
    /**
     * Hämta ett felmeddelande.
     * 
     * @param string $key Variablens namn.
     * 
     * @return string Variabelns innehåll eller en tom sträng.
     */
    public function get($key)
    {
        if (isset($this->errors[$key])) {
            return sprintf($this->html, $this->errors[$key]);
        } else {
            return '';
        }
    }
    
    /**
     * Hämta antal felmeddelanden.
     * 
     * @return integer Antal.
     */
    public function getCount()
    {
        return count($this->errors);
    }
    
    /** Tillåt inte att skapa ett objekt med new. */
    private function __construct()
    {
    }
    
    /** Tillåt inte kloning av objektet. */
    private function __clone()
    {
    }
}
