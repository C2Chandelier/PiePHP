<?php
namespace Core;

class Entity
{
    public function __construct($params){
        if(isset($params['id'])){
            $app = new ORM;
            $params = $app->read('users',$params["id"]);
        }
        $key = array_key_first($params);
        $$key = $params[array_key_first($params)];
        echo $key ."=". $$key;
    }
}

$run = new Entity(['titre' => 'LSDA','author' => 'Tolkien']);