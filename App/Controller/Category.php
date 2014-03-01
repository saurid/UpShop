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

class Category
{
    /**
     * Visa alla artiklar i en kategori
     * @param string Kategori Id
     */
    public function show($id)
    {
        Up::set('item', new \App\Model\Item());
        Up::set('category', new \App\Model\Category());
        Up::set('cart', new \App\Model\Cart());

        $items      = Up::item()->getCategory($id);
        $categories = Up::category()->getAll();
        
        if ($items) {
            Up::view()
                ->set('category', $items[0]['category'])
                ->set('title', $items[0]['category']);
        } else {
            $category = Up::category()->getById($id);
            Up::view()
                ->set('category', $category[0]['name'])
                ->set('title', $category[0]['name']);
        }
        
        echo Up::view()
            ->set('cart', Up::cart())
            ->set('categories', $categories)
            ->set('categorycount', count($categories))
            ->set('items', $items)
            ->set('itemcount', count($items))
            ->set('content', Up::view()->render('App/View/items.php'))
            ->render('App/View/layout.php');
    }
}
