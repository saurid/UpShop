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

class Category
{
    /**
     * Hämta alla kategorier
     * @return array Kategorier
     */
    public function getAll()
    {
        return Up::database()
            ->prepare(
                'SELECT category.id, category.name, COUNT(category_id) as count
                FROM category
                LEFT JOIN item ON (category_id = category.id)
                GROUP BY category.id
                ORDER BY category.name ASC'
            )
            ->execute()
            ->fetchAll();
    }

    /**
     * Hämta kategorinamn med id
     * @param integer Kategori Id
     * @return array Kategori
     */
    public function getById($id)
    {
        return Up::database()
            ->prepare('SELECT name FROM category WHERE id = :id')
            ->execute(array(':id' => $id))
            ->fetchAll();
    }

    /**
     * Lägg till kategori
     * @param string Kategorinamn
     */
    public function insert($name)
    {
        Up::database()
            ->prepare('INSERT INTO category (name) VALUES (:name)')
            ->execute(array(':name' => $name));
    }

    /**
     * Radera kategori
     * @param integer Kategori Id
     */
    public function delete($id)
    {
        Up::database()
            ->prepare('DELETE FROM category WHERE id = (:id)')
            ->execute(array(':id' => $id));
    }

    /**
     * Ändra på befintlig kategori
     * @param integer Kategori Id
     * @param string Kategorinamn
     */
    public function update($id, $name)
    {
        Up::database()
            ->prepare('UPDATE category SET name = :name WHERE id = :id')
            ->execute(array(':id' => $id, ':name' => $name));
    }
}
