<?php
/**
 * @author Ola Waljefors
 * @version 2013.4.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace Admin\Controller;

class Index extends Base
{
    /**
     * Vidarebefodra till loginsida
     */
    public function index()
    {
        header('Location: '.$this->c->site_path.'/Admin/Login');
    }
}
