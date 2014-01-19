<?php
/**
 * /UpMvc/Database.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

use UpMvc\Container as Up;

/**
 * Pagination.
 *
 * Skapa en klickbar lista med länkar till sidor när du
 * behöver visa stora mängder data en bit i taget.
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Pagination
{
    /** @type integer Totalt antal poster. */
    private $total;
    
    /** @type integer Aktuell sida. */
    private $current;

    /** @type integer Antal poster per sida. */
    private $per;

    /**
     * Konstruktor.
     * 
     * @param integer $total   Totalt antal poster.
     * @param integer $current Aktuell sida.
     * @param integer $per     Antal poster per sida.
     * 
     * @throws \InvalidArgumentException Om något av argumenten inte är ett heltal.
     */
    public function __construct($total, $current, $per = 10)
    {
        if (!is_numeric($total)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet (totalantal) måste vara ett heltal', __METHOD__));
        }
        if (!is_numeric($current)) {
            throw new \InvalidArgumentException(sprintf('%s: Andra argumentet (aktuell sida) måste vara ett heltal', __METHOD__));
        }
        if (!is_numeric($per)) {
            throw new \InvalidArgumentException(sprintf('%s: Tredje argumentet (antal per sida) måste vara ett heltal', __METHOD__));
        }

        $this->total   = $total;
        $this->current = $current;
        $this->per     = $per;
    }

    /**
     * Hämta totalt antal poster.
     * 
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Hämta aktuell sida.
     * 
     * @return integer
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Hämta antal poster per sida.
     * 
     * (alias för metoden getLimit()).
     * 
     * @return integer
     */
    public function getPer()
    {
        return $this->per;
    }

    /**
     * Hämta limit för användning i SQL-fråga.
     * 
     * (alias för metoden getPer()).
     * 
     * @return integer
     */
    public function getLimit()
    {
        return $this->per;
    }

    /**
     * Hämta offset för användning i SQL-fråga.
     * 
     * @return integer
     */
    public function getOffset()
    {
        return ($this->current - 1) * $this->per;
    }

    /**
     * Hämta totalt antal sidor.
     * 
     * @return integer
     */
    public function getPages()
    {
        return ceil($this->total / $this->per);
    }

    /**
     * Hämta färdig SQL LIMIT/OFFSET-sträng.
     * 
     * @return string
     */
    public function getSqlLimit()
    {
        return sprintf(
            'LIMIT %d OFFSET %d',
            $this->getLimit(),
            $this->getOffset()
        );
    }

    /**
     * Generera HTML-kod med länkar till sidor.
     * 
     * @return string Sträng med länkar som en onumrerad lista.
     */
    public function getNav()
    {
        return Up::view()
            ->set('pagination', $this)
            ->render('vendor/saurid/UpMvc/View/paginationnav.php', true);
    }

    /**
     * Hämta en array med de sidor som ska visas.
     * 
     * @return array
     */
    public function getArray()
    {
        if ($this->getCurrent() <= 3 OR $this->getPages() <= 5) {
            $offset = 0;
        } elseif ($this->getCurrent() >= $this->getPages()-2) {
            $offset = $this->getPages()-5;
        } else {
            $offset = $this->getCurrent()-3;
        }
        $pages = range(1, $this->getPages());
        $pages = array_slice($pages, $offset, 5);
        
        return $pages;
    }
}
