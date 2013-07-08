<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Controller;

use UpMvc;

class Category
{
    /**
     * Visa alla artiklar i en kategori
     * @param string Kategori Id
     */
    public function show($id)
    {
        $c          = UpMvc\Container::get();
        $items      = $c->item_model->getCategory($id);
        $categories = $c->category_model->getAll();
        
        if($items) {
            $c->view
                ->set('category', $items[0]['category'])
                ->set('title',    $items[0]['category']);
        } else {
            $category = $c->category_model->getById($id);
            $c->view
                ->set('category', $category[0]['name'])
                ->set('title',    $category[0]['name']);
        }
        
        echo $c->view
            ->set('cart',          $c->cart_model)
            ->set('categories',    $categories)
            ->set('categorycount', count($categories))
            ->set('items',         $items)
            ->set('itemcount',     count($items))
            ->set('content',       $c->view->render('App/View/items.php'))
            ->render('App/View/layout.php');
    }
}
