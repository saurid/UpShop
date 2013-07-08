<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Controller;

use UpMvc;

class Payment
{
    /**
     * Visa avslutad order
     */
    public function show()
    {
        $c          = UpMvc\Container::get();
        $categories = $c->category_model->getAll();
        
        echo $c->view
            ->set('title',         'Kassa')
            ->set('cart',          $c->cart_model)
            ->set('categories',    $categories)
            ->set('categorycount', count($categories))
            ->set('ordersum',      $_SESSION['ordersum'])
            ->set('orderno',       $_SESSION['orderno'])
            ->set('content',       $c->view->render('App/View/payment.php'))
            ->render('App/View/layout.php');
    }
}
