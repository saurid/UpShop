<?php
/**
 * Konfiguration för Applikationen i mappen App.
 * 
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

use UpMvc\Container as Up;

/** Databasuppgifter. */
Up::set('db_engine',   'mysql');
Up::set('db_host',     'localhost');
Up::set('db_user',     'root');
Up::set('db_password', '');
Up::set('db_name',     'upshop');

/** Övriga uppgifter om sidan. */
Up::set('site_name',  'Din exempelshop');
Up::set('site_email', 'ola@waljefors.se');

/** Up Shop-specifika konstanter. */
Up::set('image_thumb_width',  120);
Up::set('image_thumb_height', 120);
Up::set('image_size',         400);

/** Up Shop-specifika funktioner. */
require('Includes/htmlescape.php');
require('Includes/validation.php');

/** Lägg in modeller/classer i containern som closures. */
Up::set('cart',
    function () {
        return new App\Model\Cart();
    }
);
Up::set('category',
    function () {
        return new App\Model\Category();
    }
);
Up::set('item',
    function () {
        return new App\Model\Item();
    }
);
Up::set('user',
    function () {
        return new App\Model\User();
    }
);
Up::set('userrole',
    function () {
        return new App\Model\Userrole();
    }
);
Up::set('vat',
    function () {
        return new App\Model\Vat();
    }
);
Up::set('error',
    function () {
        return UpMvc\Error::getInstance();
    }
);
Up::set('shipping',
    function () {
        return new App\Logic\ShippingWeight(Up::cart());
    }
);
Up::set('order',
    function () {
        return new App\Logic\Order(Up::cart(), Up::shipping());
    }
);
