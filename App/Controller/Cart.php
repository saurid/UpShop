<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Controller;

use UpMvc;

class Cart
{
    private $c;
    private $categories;

    public function __construct()
    {
        $this->c          = UpMvc\Container::get();
        $this->categories = $this->c->category_model->getAll();
    }

    /**
     * Visa varukorgen
     */
    public function show()
    {
        echo $this->c->view
            ->set('title',         'Varukorg')
            ->set('cart',          $this->c->cart_model)
            ->set('categories',    $this->categories)
            ->set('categorycount', count($this->categories))
            ->set('error',         $this->c->error)
            ->set('order',         $this->c->order)
            ->set('request',       $this->c->request)
            ->set('shipping',      $this->c->shipping)
            ->set('user',          $this->c->user_model)
            ->set('content',       $this->c->view->render('App/View/cart.php'))
            ->render('App/View/layout.php');
    }
    
    /**
     * Skicka ordermail till kund och admin
     */
    public function order()
    {
        $this->c->view
            ->set('title',         'Varukorg')
            ->set('cart',          $this->c->cart_model)
            ->set('categories',    $this->categories)
            ->set('categorycount', count($this->categories))
            ->set('error',         $this->c->error)
            ->set('order',         $this->c->order)
            ->set('request',       $this->c->request)
            ->set('shipping',      $this->c->shipping)
            ->set('user',          $this->c->user_model);
        
        if (isset($_POST['submit'])) {

            if (!isValidEmail($this->c->request->get('email'))) {
                $this->c->error->set('email', 'E-postadressen verkar inte vara giltig!');
            }
            if (!isLength($this->c->request->get('contact'), 20)) {
                $this->c->error->set('contact', 'Du måste ange ditt namn och postadress!');
            }
            if (!isPhoneNo($this->c->request->get('phone'))) {
                $this->c->error->set('phone', 'Du måste skriva in ett telefonnummer!');
            }
            if ($this->c->error->getCount() == 0) {
                $this->c->order->setNumber();
                
                $this->c->view
                    ->set('contact', $this->c->request->get('contact'))
                    ->set('email',   $this->c->request->get('email'))
                    ->set('phone',   $this->c->request->get('phone'))
                    ->set('content', $this->c->view->render('App/View/order.php'));

                // Kundmail
                $headers =
                    'MIME-Version: 1.0' . "\r\n" .
                    'Content-type: text/html; charset=utf-8' . "\r\n" .
                    'From: ' . $this->c->site_email . "\r\n" .
                    'Reply-To: ' . $this->c->site_email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $subject = 'Orderbekräftelse från ' . $this->c->site_name;
                $message = $this->c->view->render('App/View/order_user.php');
                $errors  = false;
                
                if (!mail($this->c->request->get('email'), $subject, $message, $headers)) {
                    echo '<p>Fel: Gick ej att skicka mail till kunden.</p>';
                    $errors = true;
                }
                
                // Administratörsmail
                if (!$errors) {
                    $to      = $this->c->site_email;
                    $subject = 'Order från ' . $this->c->site_name;
                    $message = $this->c->view->render('App/View/order_admin.php');

                    if (!mail($to, $subject, $message, $headers)) {
                        echo '<p>Gick ej att skicka mail till administratören.</p>';
                        $errors = true;
                    }
                }
                
                // Order genomförd
                $this->c->cart_model->deleteAll();
                header('Location: ' . $this->c->site_path . '/Payment/show');
                exit;
            }
            else {
                $this->c->error->set('general', 'Något gick fel! Kontrollera dina inmatade uppgifter och försök igen.');
            }
        }
    
        // Om ej fel, rendrera sidan
        echo $this->c->view
            ->set('content', $this->c->view->render('App/View/cart.php'))
            ->render('App/View/layout.php');
    }
    
    /**
     * Lägg artikel i varukorg
     */
    public function add()
    {
        $this->c->cart_model->add((int)$_POST['id'], (int)$_POST['count']);
        header('Location: ' . $_POST['urlref']);
        exit;
    }
    
    /**
     * Ändra artikel (antal) i varukorg
     */
    public function edit()
    {
        $this->c->cart_model->edit((int)$_POST['id'], (int)$_POST['count']);
        header('Location: ' . $_POST['urlref']);
        exit;
    }
    
    /**
     * Ta bort artikel ur varukorg
     */
    public function delete()
    {
        $this->c->cart_model->delete((int)$_POST['id']);
        header('Location: ' . $_POST['urlref']);
        exit;
    }
    
    /**
     * Töm hela varukorgen
     */
    public function deleteAll()
    {
        $this->c->cart_model->deleteAll();
        header('Location: ' . $_POST['urlref']);
        exit;
    }
}
