<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Model;

use UpMvc;

class Vat
{
    /**
     * Hämta momssatser
     * @return array Momssatser
     */
    public function getAll()
    {
        return UpMvc\Container::get()
            ->database
            ->prepare('SELECT * FROM vat ORDER BY id ASC')
            ->execute()
            ->fetchAll();
    }
}
