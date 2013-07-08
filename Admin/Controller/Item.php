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

class Item extends Base
{
    /**
     * Visa alla artiklar
     */
    public function index()
    {
        $count      = $this->c->item_model->getCount();
        $page       = $this->c->request->get('page', 1);
        $pagination = new UpMvc\Pagination($count, $page, 25);

        $items = $this->c->item_model->getAll($pagination->getSqlLimit());

        echo $this->c->view
            ->set('title',     'Admin artiklar')
            ->set('items',     $items)
            ->set('itemcount', $count)
            ->set('nav',       $pagination->getNav())
            ->set('content',   $this->c->view->render('Admin/View/items.php'))
            ->render('Admin/View/layout.php');
    }
    
    /**
     * Lägg till artikel
     */
    public function insert()
    {
        if (isset($_POST['submit'])) {
            $insertid = $this->c->item_model->insert();
            header('Location: ' . $this->c->site_path . '/Admin/Item/update/' . $insertid);
            exit;
        }

        echo $this->c->view
            ->set('title',      'Admin lägg till artikel')
            ->set('categories', $this->c->category_model->getAll())
            ->set('vat',        $this->c->vat_model->getAll())
            ->set('content',    $this->c->view->render('Admin/View/iteminsert.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Ändra artikel
     * @param string Artikel Id
     */
    public function update($id)
    {
        if (isset($_POST['submit'])) {
            $this->c->item_model->update($id);
            header('Location: ' . $this->c->site_path . '/Admin/Item/update/' . $id);
            exit;
        }
        
        $items = $this->c->item_model->getById($id);
        echo $this->c->view
            ->set('title',      'Admin artiklar')
            ->set('items',      $items)
            ->set('itemcount',  count($items))
            ->set('categories', $this->c->category_model->getAll())
            ->set('vat',        $this->c->vat_model->getAll())
            ->set('content',    $this->c->view->render('Admin/View/itemupdate.php'))
            ->render('Admin/View/layout.php');
    }
    
    /**
     * Radera artikel
     * @param string Artikel Id
     */
    public function delete($id)
    {
        $this->c->item_model->delete($id);
        header('Location: ' . $this->c->site_path . '/Admin/Item');
        exit;
    }
}
