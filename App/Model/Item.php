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

class Item
{
    /**
     * Hämta senaste artiklar
     * @return array Artiklar
     */
    public function getLatest()
    {
        return Up::database()
            ->prepare('
                SELECT item.id, item.name, description, price, retailprice, weight, count, image, thumb, category_id, category.name AS category, vat_id, item.date AS date
                FROM item
                JOIN category ON category.id = item.category_id
                ORDER BY item.date DESC
                LIMIT 3
            ')
            ->execute()
            ->fetchAll();
    }
    
    /**
     * Hämta artiklar i viss kategori
     * @param integer Kategori Id
     * @return array Artiklar
     */
    public function getCategory($id)
    {
        return Up::database()
            ->prepare('
                SELECT item.id, item.name, description, price, retailprice, weight, count, image, thumb, category_id, category.name AS category, vat_id, item.date AS date
                FROM item
                JOIN category ON category.id = item.category_id
                WHERE category_id = :category
                ORDER BY item.name ASC
            ')
            ->execute(array(':category' => $id))
            ->fetchAll();
    }
    
    /**
     * Hämta en artikel
     * @param integer Artikel Id
     * @return array Artikel
     */
    public function getById($id)
    {
        return Up::database()
            ->prepare('
                SELECT id, name, description, price, retailprice, weight, count, image, thumb, category_id, vat_id
                FROM item
                WHERE id = :id
                LIMIT 1
            ')
            ->execute(array(':id' => $id))
            ->fetchAll();
    }
    
    /**
     * Hämta alla artiklar
     * @return array Artiklar
     */
    public function getAll($limit = '')
    {
        return Up::database()
            ->prepare("
                SELECT item.id, item.name, description, price, retailprice, weight, count, image, thumb, category_id, category.name AS category, vat_id, vat
                FROM item
                JOIN category ON category.id = item.category_id
                JOIN vat ON vat.id = item.vat_id
                ORDER BY item.name ASC
                $limit
            ")
            ->execute()
            ->fetchAll();
    }
    
    /**
     * Spara artikel i databas, samt ev bild/tumnagel
     * @return integer Artikel Id
     */
    public function insert()
    {
        // Spara artikel i databas
        $insertid = Up::database()
            ->prepare('
                INSERT
                INTO item (name, description, price, weight, count, category_id, vat_id)
                VALUES (:name, :description, :price, :weight, :count, :category_id, :vat_id)
            ')
            ->execute(array(
                ':name'        => $_POST['name'],
                ':description' => $_POST['description'],
                ':price'       => $_POST['price'],
                ':weight'      => $_POST['weight'],
                ':count'       => $_POST['count'],
                ':category_id' => $_POST['category_id'],
                ':vat_id'      => $_POST['vat_id'],
            ))
            ->lastInsertId();
        
        // Spara bild i filsystemet och databas
        if (!empty($_FILES['file']['name'])) {
        
            require('App/Logic/SimpleImage.php');
            $image = new \SimpleImage();
            $image->load($_FILES['file']['tmp_name']);

            $filename      = $insertid . '_' . $_FILES['file']['name'];
            $filenamethumb = $insertid . '_thumb_' . $_FILES['file']['name'];

            if ($image->getWidth() > $image->getHeight()) {
                $image->resizeToWidth(UpMvc\Container::get()->image_size);
                $image->save('App/View/img/items/' . $filename);
                $image->resizeToHeight(UpMvc\Container::get()->image_thumb_height);
                $image->save('App/View/img/items/' . $filenamethumb);
            }
            else {
                $image->resizeToHeight(UpMvc\Container::get()->image_size);
                $image->save('App/View/img/items/' . $filename);
                $image->resizeToWidth(UpMvc\Container::get()->image_thumb_height);
                $image->save('App/View/img/items/' . $filenamethumb);
            }

            // Spara bild i databasen
            Up::database()
                ->prepare('
                    UPDATE item
                    SET image = :filename, thumb = :filenamethumb
                    WHERE id = :id
                ')
                ->execute(array(
                    ':filename'      => $filename,
                    ':filenamethumb' => $filenamethumb,
                    ':id'            => $insertid
                ));
        }
        return $insertid;
    }

    /**
     * Uppdatera artikel i databas
     * @todo samt ev bild/tumnagel
     * @param string Artikel Id
     */
    public function update($id)
    {
        // Uppdatera artikel i databas
        Up::database()
            ->prepare('
                UPDATE item 
                SET
                    name = :name,
                    description = :description,
                    price = :price,
                    weight = :weight,
                    count = :count,
                    category_id = :category_id,
                    vat_id = :vat_id
                WHERE id = :id
            ')
            ->execute(array(
                ':id'          => $id,
                ':name'        => $_POST['name'],
                ':description' => $_POST['description'],
                ':price'       => $_POST['price'],
                ':weight'      => $_POST['weight'],
                ':count'       => $_POST['count'],
                ':category_id' => $_POST['category_id'],
                ':vat_id'      => $_POST['vat_id']
            ));
    }
    
    /**
     * Radera artikel i databas, samt ev bild/tumnagel
     * @param integer Artikel Id
     */
    function delete($id)
    {
        $item  = $this->getById($id);

        if (!empty($item[0]['image'])) {
            $thumb = 'App/View/img/items/' . $item[0]['thumb'];
            $image = 'App/View/img/items/' . $item[0]['image'];
            unlink($thumb);
            unlink($image);
        }

        Up::database()
            ->prepare('DELETE FROM item WHERE id = :id')
            ->execute(array(':id' => $id));   
    }

    /**
     * Radera artikel i databas, samt ev bild/tumnagel
     * @return integer Totalt antal poster
     */
    function getCount()
    {
        $count = Up::database()
            ->prepare('SELECT COUNT(*) AS count FROM item')
            ->execute()
            ->fetchAll();

        return $count[0]['count'];
    }
}
