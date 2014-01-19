<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Controller;

use UpMvc;
use UpMvc\Container as Up;

class Item
{
    /**
     * Visa en artikel
     * @param string Artikel Id
     */
    public function show($id)
    {
        Up::set('item',     new \App\Model\Item());
        Up::set('category', new \App\Model\Category());
        Up::set('cart',     new \App\Model\Cart());

        $item       = Up::item()->getById($id);
        $categories = Up::category()->getAll();
        
        echo Up::view()
            ->set('title',         $item[0]['name'])
            ->set('cart',          Up::cart())
            ->set('categories',    $categories)
            ->set('categorycount', count($categories))
            ->set('item',          $item[0])
            ->set('content',       Up::view()->render('App/View/item.php'))
            ->render('App/View/layout.php');
    }
}
