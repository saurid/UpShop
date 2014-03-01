<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Logic;

class ShippingWeight extends AbstractShipping
{
    /**
     * @var array Postens prislista i gram => kronor
     * @access private
     */
    private $price = array(
        20 => 6, // brev
        100 => 12,
        250 => 24,
        500 => 36,
        1000 => 48,
        2000 => 72,
        3000 => 150, // paket
        5000 => 180,
        10000 => 230,
        15000 => 280,
        20000 => 325
    );

    /**
     * @var float Eventuell fast kostnad som adderas till den rörliga
     * @access private
     */
    private $fixedprice = 20;

    /**
     * Beräkna frakten
     * Måste sätta $this->sum till fraktkostnaden
     */
    public function calculate()
    {
        // Hämta totalvikten av varukorgens artiklar
        $weight = 0;
        foreach ($this->cart->getItems() as $item) {
            $weight += $item->getWeight() * $item->getCount();
        }

        // Slå upp kostnad från prislistan
        $calc = 0;
        foreach ($this->price as $aweight => $aprice) {
            if ($weight > $aweight) {
                $calc = $aprice;
            }
        }

        // Fraktkostnad = fast pris + frakt från prislista
        $this->sum = $this->fixedprice + $calc;
    }
}
