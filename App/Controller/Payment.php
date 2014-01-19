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

class Payment
{
    /**
     * Visa avslutad order
     */
    public function show()
    {
        $categories = Up::category()->getAll();
        
        echo Up::view()
            ->set('title',         'Kassa')
            ->set('cart',          Up::cart())
            ->set('categories',    $categories)
            ->set('categorycount', count($categories))
            ->set('ordersum',      $_SESSION['ordersum'])
            ->set('orderno',       $_SESSION['orderno'])
            ->set('content',       Up::view()->render('App/View/payment.php'))
            ->render('App/View/layout.php');
    }
}
