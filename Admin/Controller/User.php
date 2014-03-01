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

class User extends Base
{
    /**
     * Visa användare
     */
    public function index()
    {
        $users = Up::user()->getAll();
        echo Up::view()
            ->set('title', 'Admin kontakter')
            ->set('users', $users)
            ->set('usercount', count($users))
            ->set('content', Up::view()->render('Admin/View/users.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Lägg till användare
     */
    public function insert()
    {
        if (isset($_POST['submit'])) {
            Up::user()->insert($_POST);
            header('Location: ' . Up::site_path() . '/Admin/User');
            exit;
        }

        echo Up::view()
            ->set('title', 'Admin lägg till kontakt')
            ->set('userroles', Up::userrole()->getAll())
            ->set('content', Up::view()->render('Admin/View/userinsert.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Ändra användare
     * @param string Användare Id
     */
    public function update($id)
    {
        if (isset($_POST['submit'])) {
            Up::user()->update($id);
            header('Location: ' . Up::site_path() . '/Admin/User');
            exit;
        }

        echo Up::view()
            ->set('title', 'Admin ändra kontakt')
            ->set('users', Up::user()->getById($id))
            ->set('userroles', Up::userrole()->getAll())
            ->set('content', Up::view()->render('Admin/View/userupdate.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Radera användare
     * @param string Användare Id
     */
    public function delete($id)
    {
        Up::user()->delete($id);
        header('Location: ' . Up::site_path() . '/Admin/User');
        exit;
    }
}
