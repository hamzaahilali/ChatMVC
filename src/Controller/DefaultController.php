<?php
/**
 * Created by PhpStorm.
 * User: HZM
 */

namespace App\Controller;

use App\App;
use App\Model\Entity\User;
use App\Model\EntityManager\UserManager;
use Core\Controller\Controller;

class DefaultController extends Controller
{

    /*
     * default route
     */
    public function home(){

        $currentPage = 'default.home';
        $this->render('home',compact('currentPage'));
    }

    /*
     * login Action
     */
    public function login() {

        if (isset($_SESSION['auth'])) {
            $this->redirectTo('default.home');
            die();
        }
        $error_login = null;

        if(!empty($_POST)) {

            $app = App::getInstance();
            $userManager = new UserManager($app->getDb());

            $login = isset($_POST['emailAuth']) ? $_POST['emailAuth'] : NULL;
            $password = isset($_POST['passwordAuth']) ? $_POST['passwordAuth'] : NULL;

            $user = $userManager->findByLogin($login);
            if ($user) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['auth'] = $user->getId();
                    $_SESSION["firstName"] = $user->getFirstName();
                    $_SESSION["lastName"] = $user->getLastName();
                    $this->redirectTo('user.index');
                } else {
                    $error_login = 'Mot de passe incorrect';
                }
            } else {
                $error_login = 'Login incorrect';
            }
        }

            $this->render('login',compact('error_login'));
    }

    /*
     * register Action
     */
    public function register() {

        if (isset($_SESSION['auth'])) {
            $this->redirectTo('default.home');
            die();
        }

        $error_register = null;

        if(!empty($_POST)) {

            if (null !== $_POST['email']
                && null !== $_POST['lastName']
                && null !== $_POST['firstName']
                && null !== $_POST['password']
                && null !== $_POST['confPassword']) {


                if ($_POST['password'] == $_POST['confPassword']) {
                    $app = App::getInstance();
                    $userManager = new UserManager($app->getDb());

                    $user = new User([
                        "login" => $_POST['email'],
                        "lastName" => $_POST['lastName'],
                        "firstName" => $_POST['firstName'],
                        "password" => password_hash($_POST['password'], PASSWORD_BCRYPT),
                        "active" => 0
                    ]);

                    $users = $userManager->findAll();
                    foreach ($users as $existingUser) {
                        if ($existingUser->getLogin() == $user->getLogin()) {
                            $error_register = 'login déjà existant';
                            $alreadyExist = true;
                        }
                    }

                    if (!isset($alreadyExist)) {
                        $userManager->add($user);
                        $id = $app->getDb()->lastInsertId();
                        $user->setId($id);
                        $_SESSION['auth'] = $user->getId();
                        $_SESSION["firstName"] = $user->getFirstName();
                        $_SESSION["lastName"] = $user->getLastName();
                        $userManager->userOnline($user);
                        $this->redirectTo('user.index');
                    }

                } else {
                    $error_register = 'Les mots de passe doivent être identiques';
                }
            } else {
                $error_register = 'Tous les champs sont obligatoires';
            }
        }

        $this->render('login',compact('error_register'));
    }

    /*
     * logout Action
     */
    public function logout(){

        $app = App::getInstance();
        $userManager = new UserManager($app->getDb());
        $user = $userManager->find($_SESSION['auth']);
        $userManager->userOffline($user);
        unset($_SESSION['auth']);

        $this->render('home');
    }


}
