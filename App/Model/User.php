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

class User
{
    /**
     * @var boolean Status på inloggning
     * @access private
     */
    private $isin = false;

    /**
     * @var array Användarinformation
     */
    public $user;

    /**
     * Sätter en sessionsvariabel med användardata
     * @uses global $_SESSION
     */
    public function __construct()
    {
        if (isset($_SESSION['user'])) {
            $this->isin = true;
            $this->user = $_SESSION['user'];
        }
    }

    /**
     * Logga in om användarinformation är rätt
     * @param string $user Användarnamn
     * @param string $pass Lösenord
     * @return bool true om det lyckades, false om det inte lyckades
     */
    public function login ($user, $pass)
    {
        $result = Up::database()
            ->prepare('SELECT email, password, contact, phone, userrole_id FROM user WHERE email = ? AND password = ?')
            ->execute(array($user, md5($pass)))
            ->fetchAll();

        if (count($result) == 1) {
            $this->isin = true;
            $this->user = $result[0];
            $_SESSION['user'] = $this->user;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logga ut användare
     * @uses global $_SESSION
     */
    public function logout()
    {
        $this->isin = false;
        unset($_SESSION['user']);
    }

    /**
     * Användare inloggad eller ej?
     * @return bool true om inloggad, false om inte
     */
    public function isIn()
    {
        return $this->isin;
    }

    /**
     * Kontrollera användarens roll
     * @return bool Sant om rollen stämmer, falskt om inte
     */
    public function hasRole($role)
    {
        if ($this->get('userrole_id') == $role) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Hämta användarens roll
     * @return integer Roll
     */
    public function role()
    {
        return $this->get('userrole_id');
    }

    /**
     * Hämta användaruppgifter
     * @return array Användaruppgifter
     */
    public function get($data)
    {
        return $this->user[$data];
    }

    /**
     * Hämta alla användaruppgifter
     * @return array Användaruppgifter
     */
    public function getAll()
    {
        return Up::database()
            ->prepare(
                'SELECT user.id, contact, email, phone, userrole.id as userrole_id, userrole.name as userrole
                FROM user
                LEFT JOIN (userrole)
                ON (userrole_id = userrole.id)
                ORDER BY email ASC'
            )
            ->execute()
            ->fetchAll();
    }

    /**
     * Hämta användaruppgifter
     * @param integer $id AnvändarId
     * @return array Användaruppgifter
     */
    public function getById($id)
    {
        return Up::database()
            ->prepare(
                'SELECT user.id AS id, contact, email, phone, userrole.id as userrole_id, userrole.name as userrole
                FROM user
                LEFT JOIN (userrole)
                ON (userrole_id = userrole.id)
                WHERE user.id = :id
                LIMIT 1'
            )
            ->execute(array(':id' => $id))
            ->fetchAll();
    }

    /**
     * Lägg till användare
     * @uses global $_POST
     */
    public function insert()
    {
        Up::database()
            ->prepare(
                'INSERT
                INTO user (userrole_id, email, contact, phone, password)
                VALUES (:userrole_id, :email, :contact, :phone, :password)'
            )
            ->execute(array(
                ':userrole_id' => $_POST['userrole_id'],
                ':email'       => $_POST['email'],
                ':contact'     => $_POST['contact'],
                ':phone'       => $_POST['phone'],
                ':password'    => $_POST['password']
            ));
    }

    /**
     * Ändra en användare
     * @param integer $id AnvändarId
     * @uses global $_POST
     */
    public function update($id)
    {
        Up::database()
            ->prepare(
                "UPDATE user
                SET
                    userrole_id = :userrole_id,
                    email       = :email,
                    contact     = :contact,
                    phone       = :phone
                WHERE id = :id"
            )
            ->execute(array(
                ':userrole_id' => $_POST['userrole_id'],
                ':email'       => $_POST['email'],
                ':contact'     => $_POST['contact'],
                ':phone'       => $_POST['phone'],
                ':id'          => $id
            ));

        // Om lösenordet ändrades
        if (!empty($_POST['password'])) {
            Up::database()
                ->prepare('UPDATE user SET password = :password WHERE id = :id')
                ->execute(array(':password' => md5($_POST['password']), ':id' => $id));
        }
    }

    /**
     * Radera användare
     * @param integer $id AnvändarId
     */
    public function delete($id)
    {
        Up::database()
            ->prepare('DELETE FROM user WHERE id = :id')
            ->execute(array(':id' => $id));
    }
}
