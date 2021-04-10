<?php
/**
 * Created by PhpStorm.
 * User: HZM
 */

namespace App\Model\Entity;

use Core\Entity\Entity;


class Message extends Entity implements \JsonSerializable
{
    private $_id;
    private $_content;
    private $_userSenderId;
    private $_userReceiverId;
    private $_dateSend;
    private $_read;


    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }


    public function getContent()
    {
        return $this->_content;
    }

    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }

    public function getUserSenderId()
    {
        return $this->_userSenderId;
    }

    public function setUserSenderId($userSenderId)
    {
        $this->_userSenderId = $userSenderId;
        return $this;
    }


    public function getUserReceiverId()
    {
        return $this->_userReceiverId;
    }

    public function setUserReceiverId($userReceiverId)
    {
        $this->_userReceiverId = $userReceiverId;
        return $this;
    }

    public function getDateSend()
    {
        return $this->_dateSend;
    }

    public function setDateSend($dateSend)
    {
        $this->_dateSend = $dateSend;
        return $this;
    }

    public function getRead()
    {
        return $this->_read;
    }

    public function setRead($read)
    {
        $this->_read = $read;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->_id,
            'content' => $this->_content,
            'userSenderId' => $this->_userSenderId,
            'userReceiverId' => $this->_userReceiverId,
            'dateSend' => $this->_dateSend,
            'read'=> $this->_read
        ];
    }
}
