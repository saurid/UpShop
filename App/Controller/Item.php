<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Controller;

use UpMvc;

class Item
{
    /**
     * Visa en artikel
     * @param string Artikel Id
     */
    public function show($id)
    {
        $c          = UpMvc\Container::get();
        $item       = $c->item_model->getById($id);
        $categories = $c->category_model->getAll();
        
        echo $c->view
            ->set('title',         $item[0]['name'])
            ->set('cart',          $c->cart_model)
            ->set('categories',    $categories)
            ->set('categorycount', count($categories))
            ->set('item',          $item[0])
            ->set('content',       $c->view->render('App/View/item.php'))
            ->render('App/View/layout.php');
    }
}
