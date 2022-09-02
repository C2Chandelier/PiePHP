<?php
require_once('./Core/Controller.php');
require_once('./Core/Request.php');

use Core\Request;

class AppController extends \Core\Controller
{
    public function __construct(){
        Request::secure_post();
        Request::secure_get();
    }
    public function index(){
        echo "salut ! Je suis la methode index de la classe AppController !";
    }
}