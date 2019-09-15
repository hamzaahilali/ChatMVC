<?php
/**
 * Created by PhpStorm.
 * User: HZM
 * Date: 15/09/2019
 * Time: 06:55
 */

namespace App\Controller;


use App\App;
use App\Model\Entity\Message;
use App\Model\EntityManager\MessageManager;
use App\Model\EntityManager\UserManager;
use Core\Controller\Controller;

class MessageController extends Controller
{

    /*
     * Message construct
     */
    public function __construct()
    {
        /*
         * check user connection
         */
        parent::__construct();
        if (!isset($_SESSION['auth'])) {
            $this->redirectTo('default.login');
            die();
        }
    }

    public function index($userId)
    {
        $app = App::getInstance();
        $userManager = new UserManager($app->getDb());
        $user1 = $userManager->find($_SESSION['auth']);
        $user2 = $userManager->find($userId);

        if ($user1 && $user2) {
            $messageManager = new MessageManager($app->getDb());
            $messages = $messageManager->loadDiscussion($user1, $user2,0);

            echo json_encode($messages);
        }
        else{
            $this->render('error.erreur404');
        }

    }

    /*
     * add Message Action
     */
    public function add()
    {

        if (!empty($_POST)) {

            $app = App::getInstance();
            $userManager = new UserManager($app->getDb());

            $userReceiver = $userManager->find($_POST['userReceiverId']);
            if ($userReceiver) {

                $app = App::getInstance();
                $messageManager = new MessageManager($app->getDb());

                $message = new Message([
                    "content" => $_POST['content'],
                    "userSenderId" => $_SESSION['auth'],
                    "userReceiverId" => $userReceiver->getId(),
                    "dateSend" => date("Y-m-d H:i:s"),
                    "read" => 0
                ]);
                $messageManager->add($message);

                $id = $app->getDb()->lastInsertId();
                $message->setId($id);

                echo json_encode($message);
            }
        }

    }


    /*
     * loading page [Like Pagination]
     */
    public function loadpage($userId,$page){

        $app = App::getInstance();
        $userManager = new UserManager($app->getDb());
        $user1 = $userManager->find($_SESSION['auth']);
        $user2 = $userManager->find($userId);
        $messages = null;
        if ($user1 && $user2) {
            $messageManager = new MessageManager($app->getDb());
            $messages = $messageManager->loadDiscussion($user1, $user2,$page);
            echo json_encode($messages);
        }
    }
}

