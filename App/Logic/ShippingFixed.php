<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Logic;

class ShippingFixed extends AbstractShipping
{
    /**
     * Beräkna fraktkostnad
     * Måste sätta $this->sum till fraktkostnaden
     */
    function calculate()
    {    
        $this->sum = $this->fixedprice;
    }
}
