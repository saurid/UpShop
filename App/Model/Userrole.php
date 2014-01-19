<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Model;

use UpMvc;
use UpMvc\Container as Up;

class Userrole
{
    /**
     * Hämta användarroller
     * @return array Roller
     */
    public function getAll()
    {
        return Up::database()
            ->prepare('SELECT * FROM userrole ORDER BY name ASC')
            ->execute()
            ->fetchAll();
    }
}
