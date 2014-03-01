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

class Category extends Base
{
    /**
     * Visa kategorier
     */
    public function index()
    {
        $categories = Up::category()->getAll();
        echo Up::view()
            ->set('title', 'Admin kategorier')
            ->set('categories', $categories)
            ->set('categorycount', count($categories))
            ->set('content', Up::view()->render('Admin/View/categories.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Lägg till kategori
     */
    public function insert()
    {
        Up::category()->insert($_POST['name']);
        header('Location: ' . Up::site_path() . '/Admin/Category');
        exit;
    }

    /**
     * Ändra kategori
     * @param string Kategori Id
     */
    public function update($id)
    {
        Up::category()->update($id, $_POST['name']);
        header('Location: ' . Up::site_path() . '/Admin/Category');
        exit;
    }

    /**
     * Radera kategori
     * @param string Kategori Id
     */
    public function delete($id)
    {
        Up::category()->delete($id);
        header('Location: ' . Up::site_path() . '/Admin/Category');
        exit;
    }
}
