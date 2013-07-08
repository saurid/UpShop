<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace Admin\Controller;

use UpMvc;
use App\Model as Model;

class Category extends Base
{
    /**
     * Visa kategorier
     */
    public function index()
    {
        $categories = $this->c->category_model->getAll();
        echo $this->c->view
            ->set('title',         'Admin kategorier')
            ->set('categories',    $categories)
            ->set('categorycount', count($categories))
            ->set('content',       $this->c->view->render('Admin/View/categories.php'))
            ->render('Admin/View/layout.php');
    }
    
    /**
     * Lägg till kategori
     */
    public function insert()
    {
        $this->c->category_model->insert($_POST['name']);
        header('Location: ' . $this->c->site_path . '/Admin/Category');
        exit;
    }
    
    /**
     * Ändra kategori
     * @param string Kategori Id
     */
    public function update($id)
    {
        $this->c->category_model->update($id, $_POST['name']);
        header('Location: ' . $this->c->site_path . '/Admin/Category');
        exit;
    }
    
    /**
     * Radera kategori
     * @param string Kategori Id
     */
    public function delete($id)
    {
        $this->c->category_model->delete($id);
        header('Location: ' . $this->c->site_path . '/Admin/Category');
        exit;
    }
}
