<?php
require_once('./src/Model/UserModel.php');
require_once('./Core/Controller.php');
require_once('./Core/Request.php');


use Core\Request;

class UserController extends \Core\Controller
{
    public function __construct()
    {
        Request::secure_post();
        Request::secure_get();
    }
    public function register()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        UserModel::getInstance()->set($email,$password);
        UserModel::getInstance()->save();
    }

    public function connect()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        UserModel::getInstance()->set($email,$password);
        UserModel::getInstance()->login();
    }

    public function add()
    {
        echo "salut ! Je suis la methode add de la classe UserController !";
        $this->render('register');
    }

    public function index()
    {
        echo "salut ! Je suis la methode index de la classe UserController !";
        $this->render('login');
    }
}
