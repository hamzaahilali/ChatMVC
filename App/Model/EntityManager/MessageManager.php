<?php
/**
 * Created by PhpStorm.
 * Message: HZM
 * Date: 14/09/2019
 * Time: 16:12
 */

namespace App\Model\EntityManager;

use App\Model\Entity\Message;
use App\Model\Entity\User;
use Core\Database\MysqlDatabase;

class MessageManager {
    private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function add(Message $message)
    {
        $statement = 'INSERT INTO messages(content,user_sender_id,user_receiver_id,date_send) VALUES(?,?,?,?)';
        $this->db->prepare($statement,[$message->getContent(),$message->getUserSenderId(),$message->getUserReceiverId(),$message->getDateSend()], true);
    }

    public function findAll(User $user1,User $user2)
    {
        $messages = [];

        $statement = 'SELECT * FROM messages WHERE (user_sender_id = ? AND user_receiver_id=?) OR (user_sender_id = ? AND user_receiver_id=?) ORDER BY date_send DESC ';
        $list = $this->db->prepare($statement,[$user1->getId(),$user2->getId(),$user2->getId(),$user1->getId()] , false);

        foreach ($list as $data) {
            $messages[] = new Message($data);
        }

        return $messages;
    }

    public function loadDiscussion(User $user1,User $user2,$page){

        $messages = [];

        $statement = 'SELECT * FROM messages WHERE (user_sender_id = ? AND user_receiver_id=?) OR (user_sender_id = ? AND user_receiver_id=?) ORDER BY date_send DESC LIMIT 9 OFFSET '.($page*9);
        $list = $this->db->prepare($statement,[$user1->getId(),$user2->getId(),$user2->getId(),$user1->getId()] , false);

        foreach ($list as $data) {
            $messages[] = new Message($data);
        }

        return $messages;
    }

}

