<?php
/**
 * /UpMvc/Request.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Klass för att handskas med requestvariabler
 * 
 * En enkel wrapper runt den globala variabeln $_REQUEST (get, post). Returnerar
 * en tom sträng, eller ett eget standarsvärde, om variabeln inte är satt. Detta
 * för att enkelt undvika felmeddelanden utan att ställa egna villkor om
 * variablerna ännu inte är satta.
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Request
{
    /**
     * $var array $_REQUEST
     * @access private
     */
    private $request;
    
    /**
     * Konstruktor
     */
    public function __construct()
    {
        if (isset($_REQUEST)) {
            $this->request = $_REQUEST;
        }
    }
    
    /**
     * Hämta en variabel
     *
     * Första argumentet är nyckeln på variabeln. Dvs namnet på den globala
     * GET- eller POST-variabel du vill nå. Andra argumentet sätter det värdet
     * som ska returneras som standard om variabeln inte är satt som GET eller
     * POST.
     *
     * @param string $key     Variablens namn (nyckel)
     * @param string $default Defaultvärde om nyckeln inte finns
     * @return string Variabelns innehåll (value) eller en tom sträng
     */
    public function get($key, $default = '')
    {
        if (isset($this->request[$key])) {
            return $this->request[$key];
        } else {
            return $default;
        }
    }
}
