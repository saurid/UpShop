<?php
/**
 * /UpMvc/Container.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * En DI-container för att hantera alla objekt i ramverket
 *
 * Klassen följer designmönstret "singleton" som gör att bara ett objekt av
 * samma typ kan finnas i systemet. Dessutom använder den sig av "dependency
 * injection"-mönstret (DI) och sk. lazy loading (objekten skapas upp först när
 * de används).
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.3.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Container
{
    /**
     * @var UpMvc\Container Lagrar instans av klassen
     * @static
     * @access private
     */
    private static $instance;
    
    /**
     * @var array Lagrad data
     * @access private
     */
    private $data;
    
    /**
     * Skapa och returnera en instans av denna klassen
     *
     * Om klassen inte redan är instansieras (skapat ett objekt), så görs
     * det, annars returneras den redan skapade instansen. Detta för att
     * endast ett objekt av typen UpMvc\Container ska finnas i systemet
     * 
     * @static
     * @return UpMvc\Container
     */
    public static function get()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    /**
     * Lagra egenskap i containern
     * 
     * @param string $key   Nyckel
     * @param mixed  $value Värde
     * @throws \InvalidArgumentException Om nyckeln inte är ett giltigt variabelnamn
     */
    public function __set($key, $value)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $key)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett giltigt variabelnamn', __METHOD__));
        }
        $this->data[$key] = $value;
    }
    
    /**
     * Returnera en egenskap
     *
     * Använder den magiska metoden __get för att returnera egenskaper.
     * Om egenskapen inte redan finns skapas ett objekt upp med namnet i
     * argumentet.
     *
     * Om argumentet är en lagrad closure anropas den och lagrar ny data
     * innan den returneras. Closures används för att konfigurera hur objekt
     * skapas upp i systemet (se config.php).
     *
     * @param string $key Nyckel
     * @throws \OutOfBoundsException Om variablen inte finns, eller inte kan instansieras
     * @return mixed
     */
    public function __get($key)
    {
        // Om nyckeln inte finns, försök skapa ett objekt
        if (!isset($this->data[$key])) {
            if (class_exists($key, true)) {
                $this->data[$key] = new $key();
            } else {
                throw new \OutOfBoundsException(sprintf('%s: Den efterfrågade variabeln finns inte och instansiering av objekt misslyckades', __METHOD__));
            }
        }

        // Om egenskapen är en closure
        if (is_a($this->data[$key], 'Closure')) {
            $this->data[$key] = $this->data[$key]();
        }

        return $this->data[$key];
    }
    
    /**
     * Tillåt inte instansiering (skapa ett objekt) utifrån med new
     * genom att sätta construct som privat
     * @access private
     */
    private function __construct()
    {
    }
    
    /**
     * Tillåt inte kloning av objektet genom att sätta
     * clone till privat
     * @access private
     */
    private function __clone()
    {
    }
}
