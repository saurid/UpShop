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
 * @version 2013.10.2
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
     * Lagra egenskap i containern med den magiska metoden __set
     * Vidarebebodrar till set() för logiken.
     * 
     * @param string $key   Nyckel
     * @param mixed  $value Värde
     */
    public function __set($key, $value)
    {
        self::set($key, $value);
    }

    /**
     * Lagra egenskap i containern med statiskt anrop
     *
     * @static
     * @param string $key   Nyckel
     * @param mixed  $value Värde
     * @throws \InvalidArgumentException Om nyckeln inte är ett giltigt variabelnamn
     */
    public static function set($key, $value)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $key)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett giltigt variabelnamn', __METHOD__));
        }
        self::get()->data[$key] = $value;
    }

    /**
     * Returnera en egenskap med den magiska metoden __get
     * Vidarebebodrar till fetch() för logiken.
     * 
     * @param string $key Nyckel
     * @return mixed
     */
    public function __get($key)
    {
        return $this->fetch($key);
    }

    /**
     * Returnera en egenskap med den magiska metoden __callStatic
     * Anropas statiskt och Vidarebebodrar till fetch() för logiken.
     *
     * @static
     * @param string $key  Nyckel
     * @param string $args Används ej (ännu), men krävs av __callStatic()
     * @return mixed
     */
    public static function __callStatic($key, $args = null)
    {
        return self::get()->fetch($key);
    }

    /**
     * Returnera en egenskap
     *
     * Om egenskapen inte redan finns skapas ett objekt upp med namnet i
     * argumentet.
     *
     * Om argumentet är en lagrad closure anropas den och lagrar ny data
     * innan den returneras. Closures används för att konfigurera hur objekt
     * skapas upp i systemet (se config.php).
     *
     * @access protected
     * @param string $key Nyckel
     * @throws \OutOfBoundsException Om variablen inte finns, eller inte kan instansieras
     * @return mixed
     */
    protected function fetch($key)
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
     * 
     * @access private
     */
    private function __construct()
    {
    }
    
    /**
     * Tillåt inte kloning av objektet genom att sätta
     * clone till privat
     * 
     * @access private
     */
    private function __clone()
    {
    }
}
