<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace Admin\Controller;

use UpMvc;
use UpMvc\Container as Up;

class Base
{
    /**
     * Sätt upp gemensamma objekt och variabler
     */
    public function __construct()
    {
        Up::view()
            ->set('user', Up::user())
            ->set('request', Up::request())
            ->set('error', Up::error());
    }
}
