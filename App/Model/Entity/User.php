<?php
/**
 * Created by PhpStorm.
 * User: HZM
 * Date: 14/09/2019
 * Time: 16:12
 */

namespace App\Model\Entity;

use Core\Entity\Entity;

class User extends Entity
{
    private $_id;
    private $_login;
    private $_firstName;
    private $_lastName;
    private $_password;
    private $_active;

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id){
         $this->_id = $id;

         return $this;
    }

    public function getLogin()
    {
        return $this->_login;
    }

    public function setLogin($login){
        $this->_login = $login;
        return $this;
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;

        return $this;
    }

    public function getLastName()
    {
        return $this->_lastName;
    }

    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;

        return $this;
    }


    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;

        return $this;
    }

    public function getActive()
    {
        return $this->_active;
    }

    public function setActive($active)
    {
        $this->_active = $active;

        return $this;
    }

    public function getFullName(){
        return $this->_lastName .' '. $this->_firstName;
    }

}
