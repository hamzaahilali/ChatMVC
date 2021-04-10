<?php
/**
 * Created by PhpStorm.
 * User: HZM
 */

namespace App\Model\EntityManager;

use Core\Database\MysqlDatabase;
use App\Model\Entity\User;

class UserManager {
    private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function add(User $user)
    {
        $statement = 'INSERT INTO users(login,lastName,firstName,password,active) VALUES(?,?,?,?,?)';
        $this->db->prepare($statement,[$user->getLogin(),$user->getLastName(),$user->getFirstName(),$user->getPassword(),$user->getActive()], true);
    }

    public function delete($id)
    {
        $statement = 'DELETE FROM users WHERE id = ?';
        $this->db->prepare($statement,[(int) $id], true);
    }

    public function update(User $user)
    {
        $statement = 'UPDATE users SET password= ?, lastName= ?, firstName= ?,active= ? WHERE id = ?';
        $this->db->prepare($statement,[$user->getPassword(),$user->getLastName(),$user->getFirstName(),$user->getActive(), $user->getId()], true);
    }

    public function find($id)
    {
        $statement = 'SELECT * FROM users WHERE id = ?';
        $data = $this->db->prepare($statement,[$id], true);

        if ($data) {
            return new User($data);
        } else {
            return false;
        }
    }

    public function findByLogin($login)
    {
        $statement = 'SELECT * FROM users WHERE login = ?';
        $data = $this->db->prepare($statement,[$login], true);

        if ($data) {
            return new User($data);
        } else {
            return false;
        }
    }

    public function findAll()
    {
        $users = [];

        $statement = 'SELECT * FROM users';
        $list = $this->db->prepare($statement,[] , false);

        foreach ($list as $data) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function userOnline($user){
        $statement = 'UPDATE users SET active= true WHERE id = ?';
        $this->db->prepare($statement,[ $user->getId()], true);
    }

    public function userOffline($user){
        $statement = 'UPDATE users SET active= false WHERE id = ?';
        $this->db->prepare($statement,[ $user->getId()], true);
    }

    public function getAllOnlineUsers(){

        $users = [];

        $statement = 'SELECT * FROM users WHERE active = true AND id != ?';
        $list = $this->db->prepare($statement,[$_SESSION['auth']] , false);

        foreach ($list as $data) {
            $users[] = new User($data);
        }

        if (count($users)>0) {
            return $users;
        } else {
            return false;
        }
    }
    public function getAllOfflineUsers(){

        $users = [];

        $statement = 'SELECT * FROM users WHERE active = false AND id != ?';
        $list = $this->db->prepare($statement,[$_SESSION['auth']] , false);

        foreach ($list as $data) {
            $users[] = new User($data);
        }

        if (count($users)>0) {
            return $users;
        } else {
            return false;
        }
    }


}

