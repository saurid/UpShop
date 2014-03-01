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

class Login extends Base
{
    /**
     * Visa loginsida
     */
    public function index()
    {
        echo Up::view()
            ->set('user', Up::user())
            ->set('request', Up::request())
            ->set('error', Up::error())
            ->set('title', 'Admin login')
            ->set('content', Up::view()->render('Admin/View/login.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Logga in
     */
    public function login()
    {
        Up::user()->login(
            Up::request()->get('email'),
            Up::request()->get('password')
        );

        if (Up::user()->isIn()) {
            header('Location: ' . Up::site_path() . '/Admin/Item');
            exit;
        } else {
            Up::error()->set('login', 'Användare eller lösenord är felaktigt');
            $this->index();
        }
    }

    /**
     * Logga ut
     */
    public function logout()
    {
        Up::user()->logout();
        header('Location: ' . Up::site_path() . '/Admin/Login');
        exit;
    }
}
