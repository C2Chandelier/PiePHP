<?php

require_once('./Core/Router.php');

use Core\Router;

Router::connect('/', ['Controller' => 'App', 'action' => 'index']);
Router::connect('/register', ['Controller' => 'User', 'action' => 'add']);