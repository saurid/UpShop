<?php
/**
 * /UpMvc/Role.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Sätt rättigheter i ramverket
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.7
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Role
{
    /**
     * @var Rollens namn
     * @access private
     */
    private $id;
    
    /**
     * @var Lagrade roller
     * @access private
     */
    private $role;

    /**
     * Konstruktor
     *
     * @todo Typkontrollera $id
     * @param string $id Namn på roll
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Lägg till och lagra ny roll
     *
     * @param \UpMvc\Role $role
     * @return \UpMvc\Role $this
     */
    public function set(Role $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Kontrollera om objektet är, eller har rollen lagrad
     *
     * @param string $id Namn på roll att testa mot
     * @return bool True om rollen finns, false om den inte finns
     */
    public function has($id)
    {
        if ($id == $this->id) {
            return true;
        }
        if (isset($this->role)) {
            foreach ($this->role as $role) {
                if ($role->has($id)) {
                    return true;
                }
            }
        }
        return false;
    }
}
