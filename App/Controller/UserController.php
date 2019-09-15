<?php
/**
 * Created by PhpStorm.
 * User: HZM
 * Date: 14/09/2019
 * Time: 17:20
 */

namespace App\Controller;

use App\App;
use App\Model\EntityManager\UserManager;
use Core\Controller\Controller;

class UserController extends Controller
{
    /*
     * User construct
     */
    public function __construct()
    {
        /*
         * check user connection
         */
        parent::__construct();
        if (!isset($_SESSION['auth'])) {
            header("Location: default.login");
            die();
        }
    }

    public function index(){
        $app = App::getInstance();
        $userManager = new UserManager($app->getDb());

        $usersOnline = $userManager->getAllOnlineUsers();
        $usersOffline = $userManager->getAllOfflineUsers();


        $this->render('user.index',compact('usersOnline','usersOffline'));
    }


}
