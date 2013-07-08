<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Model;

use UpMvc;

class Userrole
{
    /**
     * Hämta användarroller
     * @return array Roller
     */
    public function getAll()
    {
        return UpMvc\Container::get()
            ->database
            ->prepare('SELECT * FROM userrole ORDER BY name ASC')
            ->execute()
            ->fetchAll();
    }
}
