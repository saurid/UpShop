<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Logic;

class Item
{
    /**
     * $var integer Antal artiklar
     * @access private
     */
    private $count;

    /**
     * $var integer Artikel Id
     * @access private
     */
    private $id;

    /**
     * $var string Artikelns namn
     * @access private
     */
    private $name;

    /**
     * $var float Artikelns pris
     * @access private
     */
    private $price;

    /**
     * $var float Artikelns återförsäljarpris
     * @access private
     */
    private $retailprice;

    /**
     * $var float Artikelns vikt
     * @access private
     */
    private $weight;

    /**
     * $var float Artikelns momssats
     * @access private
     */
    private $vat;

    /**
     * $var string Filnamn på artikelns bild
     * @access private
     */
    private $image;

    /**
     * Konstruktor
     * @param $count integer Antal
     * @param $id integer Artikelns id-nummer
     * @param $name string Namn
     * @param $price float Pris inkl. moms
     * @param $retailprice float återförsäljares pris inkl. moms
     * @param weight integer Vikt
     * @param $vat integer Momssats
     * @param $image string Bilds länkadress
     */
    function __construct($count, $id, $name, $price, $retailprice, $weight, $vat, $image)
    {
        $this->count = $count;
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->retailprice = $retailprice;
        $this->weight = $weight;
        $this->vat = $vat;
        $this->image = $image;
    }
    
    /**
     * Hämta artikelns id-nummer
     * @return integer Id-nummer
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Hämta antalet
     * @return integer Antal
     */
    function getCount()
    {
        return $this->count;
    }

    /**
     * Addera antal
     * @param $count integer Antal
     */
    function addCount($count)
    {
        $this->count += $count;
    }

    /**
     * Sätt nytt antal
     * @param $count integer Antal
     */
    function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * Hämta namn
     * @return string Namn
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * Hämta pris inkl. moms
     * @return float Pris
     */
    function getPriceIncl()
    {
        return $this->price;
    }

    /**
     * Hämta pris exkl. moms
     * @return float Pris
     */
    function getPriceExcl()
    {
        return $this->price * (1/(1*((100+ $this->vat )/100)));
    }

    /**
     * Hämta momssats
     * @return integer Momssats
     */
    function getVat()
    {
        return $this->vat;
    }

    /**
     * Hämta vikt
     * @return integer Vikt
     */
    function getWeight()
    {
        return $this->weight;
    }
    
    /**
     * Hämta länk till bild
     * @return string Bildlänk
     */
    function getImage()
    {
        return $this->image;
    }

    /**
     * Hämta summerad kostnad för artikeln inkl. moms
     * @return integer Summa
     */
    function getSumIncl()
    {
        return $this->count * $this->price;
    }
    
    /**
     * Hämta summerad kostnad för artikeln inkl. moms för återförsäljare
     * @return integer Summa
     */
    function getRetailSumIncl()
    {
        return $this->count * $this->retailprice;
    }
    
    /**
     * Hämta summerad kostnad för artikeln exkl. moms
     * @return integer Summa
     */
    function getSumExcl()
    {
        return $this->count * $this->price * (1/(1*((100+ $this->vat )/100)));
    }

    /**
     * Hämta summerad kostnad för artikeln exkl. moms för återförsäljare
     * @return integer Summa
     */
    function getRetailSumExcl()
    {
        return $this->count * $this->retailprice * (1/(1*((100+ $this->vat )/100)));
    }
}
