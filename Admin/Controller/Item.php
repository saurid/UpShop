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

class Item extends Base
{
    /**
     * Visa alla artiklar
     */
    public function index()
    {
        $count      = Up::item()->getCount();
        $page       = Up::request()->get('page', 1);
        $pagination = new UpMvc\Pagination($count, $page, 25);

        $items = Up::item()->getAll($pagination->getSqlLimit());

        echo Up::view()
            ->set('title', 'Admin artiklar')
            ->set('items', $items)
            ->set('itemcount', $count)
            ->set('nav', $pagination->getNav())
            ->set('content', Up::view()->render('Admin/View/items.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Lägg till artikel
     */
    public function insert()
    {
        if (isset($_POST['submit'])) {
            $insertid = Up::item()->insert();
            header('Location: ' . Up::site_path() . '/Admin/Item/update/' . $insertid);
            exit;
        }

        echo Up::view()
            ->set('title', 'Admin lägg till artikel')
            ->set('categories', Up::category()->getAll())
            ->set('vat', Up::vat()->getAll())
            ->set('content', Up::view()->render('Admin/View/iteminsert.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Ändra artikel
     * @param string Artikel Id
     */
    public function update($id)
    {
        if (isset($_POST['submit'])) {
            Up::item()->update($id);
            header('Location: ' . Up::site_path() . '/Admin/Item/update/' . $id);
            exit;
        }

        $items = Up::item()->getById($id);
        echo Up::view()
            ->set('title', 'Admin artiklar')
            ->set('items', $items)
            ->set('itemcount', count($items))
            ->set('categories', Up::category()->getAll())
            ->set('vat', Up::vat()->getAll())
            ->set('content', Up::view()->render('Admin/View/itemupdate.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Radera artikel
     * @param string Artikel Id
     */
    public function delete($id)
    {
        Up::item()->delete($id);
        header('Location: ' . Up::site_path() . '/Admin/Item');
        exit;
    }
}
