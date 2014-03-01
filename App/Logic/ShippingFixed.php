<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Logic;

class ShippingFixed extends AbstractShipping
{
    /**
     * Beräkna fraktkostnad
     * Måste sätta $this->sum till fraktkostnaden
     */
    public function calculate()
    {
        $this->sum = $this->fixedprice;
    }
}
