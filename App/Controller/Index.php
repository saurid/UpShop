<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Controller;

use UpMvc;

class Index
{
    /**
     * Visa startsidan
     */
    public function index()
    {
        $c          = UpMvc\Container::get();
        $items      = $c->item_model->getLatest();
        $categories = $c->category_model->getAll();
        
        echo $c->view
            ->set('title',         'Hem')
            ->set('cart',          $c->cart_model)
            ->set('categories',    $categories)
            ->set('categorycount', count($categories))
            ->set('category',      'Nya produkter')
            ->set('items',         $items)
            ->set('itemcount',     count($items))
            ->set('content',       $c->view->render('App/View/items.php'))
            ->render('App/View/layout.php');
    }
}
