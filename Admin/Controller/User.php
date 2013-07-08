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

class User extends Base
{
    /**
     * Visa användare
     */
    public function index()
    {
        $users = $this->c->user_model->getAll();
        echo $this->c->view
            ->set('title',     'Admin kontakter')
            ->set('users',     $users)
            ->set('usercount', count($users))
            ->set('content',   $this->c->view->render('Admin/View/users.php'))
            ->render('Admin/View/layout.php');
    }
    
    /**
     * Lägg till användare
     */
    public function insert()
    {
        if(isset($_POST['submit'])) {
            $this->c->user_model->insert($_POST);
            header('Location: ' . $this->c->site_path . '/Admin/User');
            exit;
        }

        echo $this->c->view
            ->set('title',     'Admin lägg till kontakt')
            ->set('userroles', $this->c->user_modelrole->getAll())
            ->set('content',   $this->c->view->render('Admin/View/userinsert.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Ändra användare
     * @param string Användare Id
     */
    public function update($id)
    {
        if (isset($_POST['submit'])) {
            $this->c->user_model->update($id);
            header('Location: ' . $this->c->site_path . '/Admin/User');
            exit;
        }

        echo $this->c->view
            ->set('title',     'Admin ändra kontakt')
            ->set('users',     $this->c->user_model->getById($id))
            ->set('userroles', $this->c->user_modelrole->getAll())
            ->set('content',   $this->c->view->render('Admin/View/userupdate.php'))
            ->render('Admin/View/layout.php');
    }

    /**
     * Radera användare
     * @param string Användare Id
     */
    public function delete($id)
    {
        $this->c->user_model->delete($id);
        header('Location: ' . $this->c->site_path . '/Admin/User');
        exit;
    }
}
