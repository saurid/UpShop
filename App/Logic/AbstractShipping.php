<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Logic;

abstract class AbstractShipping
{
    /**
     * $var model_cart object
     * @access protected
     */
    protected $cart;

    /**
     * $var float Momssats på frakt
     * @access protected
     */
    protected $vat = 25;

    /**
     * $var float Summa för frakt
     * @access protected
     */
    protected $sum = 0;

    /**
     * Konstruktor
     * @param object $cart Varukorgobjekt
     */
    function __construct($cart)
    {
        $this->cart = $cart;
        $this->calculate();
    }

    /**
     * Beräkna fraktkostnad
     * @abstract
     */
    abstract function calculate();
    
    /**
     * Hämta fraktkostnad inkl. moms
     * @return float Summa
     */
    function getIncl()
    {
        return $this->sum;
    }
    
    /**
     * Hämta fraktkostnad exkl. moms
     * @return float Summa
     */
    function getExcl()
    {
        return $this->sum * (1/(1*((100+ $this->vat )/100)));
    }
}
