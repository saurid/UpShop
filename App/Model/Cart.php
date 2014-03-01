<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Model;

use UpMvc;
use UpMvc\Container as Up;

class Cart
{
    /**
     * @var array Artiklar
     * @access private
     */
    private $items = array();

    /**
     * Hämta ev. varukorg i sessionsvariabel
     * @uses global $_SESSION
     */
    public function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->items = $_SESSION['cart'];
        }
    }

    /**
     * Lagra varukorg i sessionsvariabel
     * @uses global $_SESSION
     */
    public function __destruct()
    {
        $_SESSION['cart'] = $this->items;
    }

    /**
     * Hämta varukorgens artiklar
     * @return array Varukorgens innehåll
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Hämta antal artiklar i varukorgen
     * @return integer Antal artiklar
     */
    public function getItemCount($id)
    {
        if (isset($this->items[$id])) {
            return $this->items[$id]->getCount();
        } else {
            return 0;
        }
    }

    /**
     * Lägg till artikel i varukorgen
     * @param $id integer Artikelns idnr
     * @param $count integer Antal som ska läggas till
     */
    public function add($id, $count)
    {
        if ($count >= 0) {
            $result = Up::database()
                ->prepare(
                    'SELECT item.id AS id, item.name AS name, price, retailprice, weight, count, image, vat AS vat
                    FROM item
                    LEFT JOIN (vat)
                    ON (vat_id = vat.id)
                    WHERE item.id = ?
                    LIMIT 1'
                )
                ->execute(array($id))
                ->fetchAll();

            if (!isset($this->items[$id])) {
                $this->items[$id] = new \App\Logic\Item(
                    $count,
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['price'],
                    $result[0]['retailprice'],
                    $result[0]['weight'],
                    $result[0]['vat'],
                    $result[0]['image']
                );
            } else {
                $this->items[$id]->addCount($count);
            }
            if ($this->items[$id]->getCount() > $result[0]['count']) {
                $this->items[$id]->setCount($result[0]['count']);
            }
        }
    }

    /**
     * Ändra antal artiklar i varukorgen
     * (om artikelns slutliga antal blir noll, ta bort helt)
     * @param $id integer Artikelns idnr
     * @param $count integer Antal som ska ändras till
     */
    public function edit($id, $count)
    {
        $result = Up::database()
            ->prepare(
                'SELECT item.id AS id, item.name AS name, price,    retailprice, weight, count, image, vat AS vat
                FROM item
                LEFT JOIN (vat)
                ON (vat_id = vat.id)
                WHERE item.id = ?
                LIMIT 1;'
            )
            ->execute(array($id))
            ->fetchAll();

        if ($count <= 0) {
            unset($this->items[$id]);
        } else {
            $this->items[$id]->setCount($count);
            if ($this->items[$id]->getCount() > $result[0]['count']) {
                $this->items[$id]->setCount($result[0]['count']);
            }
        }
    }

    /**
     * Ta bort artikel från varukorgen
     * @param $id integer Artikelns idnr
     */
    public function delete($id)
    {
        unset($this->items[$id]);
    }

    /**
     * Töm hela varukorgen
     * @uses global $_SESSION
     */
    public function deleteAll()
    {
        $this->items = array();
        unset($_SESSION['cart']);
    }

    /**
     * Hämta totala antalet artiklar i varukorgen
     * @return integer Antalet artiklar
     */
    public function getCount()
    {
        $count = 0;
        foreach ($this->items as $item) {
            $count += $item->getCount();
        }
        return $count;
    }

    /**
     * Hämta totala totala kostnaden av varukorgen inkl. moms
     * @return integer Summa
     */
    public function getSumIncl()
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getSumIncl();
        }
        return $sum;
    }

    /**
     * Hämta totala totala konstnaden av varukorgen exkl. moms
     * @return integer Summa
     */
    public function getSumExcl()
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getSumExcl();
        }
        return $sum;
    }
}
