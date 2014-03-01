<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Logic;

use App\Model as Model;

class Order
{
    /**
     * $var App\Model\Cart object
     * @access private
     */
    private $cart;

    /**
     * $var App\Shipping object
     * @access private
     */
    private $shipping;

    /**
     * $var string Ordernummer
     * @access private
     */
    private $number;

    /**
     * Konstruktor
     * @param App\Model\Cart object Varukorgobjekt
     * @param App\Shipping object Fraktobjekt
     */
    public function __construct(Model\Cart $cart, AbstractShipping $shipping)
    {
        $this->cart = $cart;
        $this->shipping = $shipping;
        if (isset($_SESSION['orderno'])) {
            $this->number = $_SESSION['orderno'];
        }
    }

    /**
     * Hämta varukorgens totala summa inkl. moms
     * @return float Summa
     */
    public function getSumIncl()
    {
        $ordertotal = $this->cart->getSumIncl() + $this->shipping->getIncl();
        if (count($this->cart->getItems()) > 0) {
            $_SESSION['ordersum'] = $ordertotal;
        }
        return $ordertotal;
    }

    /**
     * Hämta varukorgens totala summa exkl. moms
     * @return float Summa
     */
    public function getSumExcl()
    {
        return $this->cart->getSumExcl() + $this->shipping->getExcl();
    }

    /**
     * Skapa ordernummer
     * @return string Ordernummer
     */
    public function createNumber()
    {
        $microtime = explode(' ', microtime());
        return date("His", $microtime[1]) . '-' . substr($microtime[0], 2, 5);
    }

    /**
     * Sätt ordernummer
     * @uses global @_SESSION
     */
    public function setNumber()
    {
        $no = $this->createNumber();
        $_SESSION['orderno'] = $no;
        $this->number = $no;
    }

    /**
     * Hämta ordernummer
     * @return string Ordernummer
     */
    public function getNumber()
    {
        return $this->number;
    }
}
