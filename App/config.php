<?php
/**
 * Konfiguration för Applikationen i mappen App
 *
 * @author Ola Waljefors
 * @package UpShop
 * @version 2013.1.1
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

$c = UpMvc\Container::get();

/**
 * Databasuppgifter
 */
$c->db_engine   = 'mysql';
$c->db_host     = 'localhost';
$c->db_user     = 'root';
$c->db_password = '';
$c->db_name     = 'upshop';

/**
 * Övriga uppgifter om sidan
 */
$c->site_name     = 'Din exempelshop';
$c->site_email    = 'min.email@domänen.se';

/**
 * Up Shop-specifika konstanter
 */
$c->image_thumb_width  = 120;
$c->image_thumb_height = 120;
$c->image_size         = 400;

/**
 * Up Shop-specifika funktioner
 */
require('Includes/htmlescape.php');
require('Includes/validation.php');

/**
 * Lägg in modeller/classer i containern som closures
 */
$c->cart_model = function () {
    return new App\Model\Cart();
};
$c->category_model = function () {
    return new App\Model\Category();
};
$c->item_model = function () {
    return new App\Model\Item();
};
$c->user_model = function () {
    return new App\Model\User();
};
$c->userrole_model = function () {
    return new App\Model\Userrole();
};
$c->vat_model = function () {
    return new App\Model\Vat();
};
$c->error = function () {
    return UpMvc\Error::getInstance();
};
$c->shipping = function () use ($c) {
    return new App\Logic\ShippingWeight($c->cart_model);
};
$c->order = function () use ($c) {
    return new App\Logic\Order($c->cart_model, $c->shipping);
};
