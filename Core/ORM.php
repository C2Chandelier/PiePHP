<?php

namespace Core;
use PDO;
use PDOException;
require_once("./Core/MyPDO.php");

class ORM
{
    public function create($table, $fields)
    {
        $keys = array_keys($fields);
        $value = [];
        for($i = 0; $i < count($keys); $i++){
            array_push($value,$keys[$i]);
        }
        $columns = implode(",", $keys);
        $values = implode(",", $value);

        $query = "INSERT INTO $table (:columns) VALUES (:values);";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute([':columns' => $columns, ':values' => $values]);
        $id = MyPDO::getInstance()->lastInsertId();
        return $id;
    }

    public function read($table,$id){
        $query = "SELECT * FROM $table WHERE id=:id;";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute([":id" => intval($id)]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($table, $id, $fields){ 

        $keys = array_keys($fields);
        $value = [];
        for($i = 0; $i < count($keys); $i++){
            array_push($value,$keys[$i]);
        }

        $request = "";
        for($j = 0; $j < count($keys); $j++){
            $request .= $keys[$j] . " = " . $value[$j] . ", ";
        }

        $query = "UPDATE $table SET :request WHERE id=:id;";

        try{
            $statement = MyPDO::getInstance()->prepare($query);
            $statement->execute([':request' => $request, ":id" => intval($id)]);
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($table, $id){

        $query = "DELETE FROM $table WHERE id = :id;";

        try{
            $statement = MyPDO::getInstance()->prepare($query);
            $statement->execute([':id' => intval($id)]);
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function find($table, $param = array(
        'WHERE' => '1',
        'ORDER BY' => 'id ASC',
        'LIMIT' => ''
    ))
    {   
        if(!is_array($param) || $param == []){
            $param = array(
                'WHERE' => '1',
                'ORDER BY' => 'id ASC',
                'LIMIT' => '');
        }

        if($param['LIMIT'] == ""){
            $limit = "";
        }
        else{
            $limit = "LIMIT " . $param['LIMIT'];
        }

        $query = "SELECT * FROM $table WHERE id=:id ORDER BY :order $limit;";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute([":id" => intval($param['WHERE']), ":order" => $param['ORDER BY']]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

