<?php
/**
 * /UpMvc/Container.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * En DI-container för att hantera alla objekt i ramverket.
 *
 * Klassen följer designmönstret "singleton" som gör att bara ett objekt av
 * samma typ kan finnas i systemet. Dessutom använder den sig av "dependency
 * injection"-mönstret (DI) och sk. lazy loading (objekten skapas upp först när
 * de används).
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2013.12.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Container
{
    /** @type UpMvc\Container Lagrar instans av klassen. */
    private static $instance;
    
    /** @type array Lagrad data. */
    private $data;
    
    /**
     * Skapa och returnera en instans av denna klassen.
     *
     * Om klassen inte redan är instansieras (skapat ett objekt), så görs
     * det, annars returneras den redan skapade instansen. Detta för att
     * endast ett objekt av typen UpMvc\Container ska finnas i systemet.
     * 
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
     * Lagra egenskap i containern med den magiska metoden __set.
     * 
     * Vidarebebodrar till set() för logiken.
     * 
     * @param string $key   Nyckel
     * @param mixed  $value Värde
     *
     * @deprecated 2013.12.1
     */
    public function __set($key, $value)
    {
        self::set($key, $value);
    }

    /**
     * Lagra egenskap i containern med statiskt anrop.
     *
     * @param string $key   Nyckel
     * @param mixed  $value Värde
     * 
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
     * Returnera en egenskap med den magiska metoden __get.
     * 
     * Vidarebebodrar till fetch() för logiken.
     *
     * @param string $key Nyckel
     * 
     * @deprecated 2013.12.1
     * @return mixed
     */
    public function __get($key)
    {
        return $this->fetch($key, null);
    }

    /**
     * Returnera en egenskap med den magiska metoden __callStatic.
     * 
     * Anropas statiskt och vidarebebodrar till fetch() för logiken.
     *
     * @param string $key  Nyckel
     * @param array  $args Argument
     * 
     * @return mixed
     */
    public static function __callStatic($key, $args = null)
    {
        return self::get()->fetch($key, $args);
    }

    /**
     * Returnera en egenskap.
     *
     * Om egenskapen inte redan finns skapas ett objekt upp med namnet i
     * argumentet. Om argumentet är en lagrad closure anropas den och lagrar
     * ny data innan den returneras. Closures används för att konfigurera hur
     * objekt skapas upp i systemet (se config.php).
     *
     * @param string $key  Nyckel
     * @param array  $args Parametrar
     * 
     * @throws \OutOfBoundsException Om variablen inte finns, eller inte kan instansieras
     * @return mixed
     */
    protected function fetch($key, $args)
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
            $this->data[$key] = call_user_func_array($this->data[$key], $args);
        }

        return $this->data[$key];
    }
    
    /** Tillåt inte instansiering med new eftersom construct är privat. */
    private function __construct()
    {
    }
    
    /** Tillåt inte kloning av objektet eftersom clone är privat. */
    private function __clone()
    {
    }
}
