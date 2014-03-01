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

class Index
{
    /**
     * Visa startsidan
     */
    public function index()
    {
        Up::set('item', new \App\Model\Item());
        Up::set('category', new \App\Model\Category());
        Up::set('cart', new \App\Model\Cart());
        
        $items      = Up::item()->getLatest();
        $categories = Up::category()->getAll();
        
        echo Up::view()
            ->set('title', 'Hem')
            ->set('cart', Up::cart())
            ->set('categories', $categories)
            ->set('categorycount', count($categories))
            ->set('category', 'Nya produkter')
            ->set('items', $items)
            ->set('itemcount', count($items))
            ->set('content', Up::view()->render('App/View/items.php'))
            ->render('App/View/layout.php');
    }
}
