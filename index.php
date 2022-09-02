<?php

//define('BASE_URI',str_replace('\\' , '/' , substr(__DIR__ , strlen($_SERVER['DOCUMENT_ROOT']))));
define('BASE_URI','/' . basename(__DIR__));
require_once(implode(DIRECTORY_SEPARATOR,['Core' , 'autoload.php']));
$app = new Core\Core();
//$app->run();
//$app->run_dyn();
$app->testORM();





echo "<pre>";
/* echo "Variable POST['email']=" . $_POST['email'] . PHP_EOL;
echo "Variable POST['password']=" . $_POST['password'] . PHP_EOL;
var_dump($_GET); */
//var_dump($_SERVER);
echo "</pre>";




