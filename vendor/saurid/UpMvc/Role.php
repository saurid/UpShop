<?php
/**
 * /UpMvc/Role.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Sätt rättigheter i ramverket.
 * 
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2013.2.7
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Role
{
    /** @type Rollens namn. */
    private $id;
    
    /** @type Lagrade roller */
    private $role;

    /**
     * Konstruktor.
     *
     * @param string $id Namn på roll.
     *
     * @todo Typkontrollera $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Lägg till och lagra ny roll.
     *
     * @param \UpMvc\Role $role Rollobjekt.
     * 
     * @return \UpMvc\Role $this Den aktuella instansen.
     */
    public function set(Role $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Kontrollera om objektet är, eller har rollen lagrad.
     *
     * @param string $id Namn på roll att testa mot.
     * 
     * @return bool True om rollen finns, false om den inte finns.
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
