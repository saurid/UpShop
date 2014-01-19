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

class Index extends Base
{
    /**
     * Vidarebefodra till loginsida
     */
    public function index()
    {
        header('Location: ' . Up::site_path() . '/Admin/Login');
    }
}
