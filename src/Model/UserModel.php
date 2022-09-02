<?php

require_once("./Core/MyPDO.php");
require_once("./Core/Entity.php");

use Core\MyPDO;

class UserModel //extends Core\Entity

{
    private static $instance = null;
    private $email = null;
    private $password = null;

    public function set($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new UserModel();
        }
        return self::$instance;
    }

    public function login()
    {
        $query = "SELECT * FROM users WHERE email LIKE :email AND password LIKE :password";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute([':email' => $this->email, ':password' => $this->password]);
        $result = $statement->fetch();
        $id = $result['id'];
        if ($statement->rowCount() == 1) {
            echo "Connexion OK" . PHP_EOL;
            return $id;
        } else {
            echo "Connexion FAIL" . PHP_EOL;
        }
    }

    public function save()
    {
        $query2 = "SELECT * FROM users WHERE email LIKE :email AND password LIKE :password";
        $statement2 = MyPDO::getInstance()->prepare($query2);
        $statement2->execute([':email' => $this->email, ':password' => $this->password]);
        $result = $statement2->fetch();
        if ($statement2->rowCount() == 0) {
            $query = "INSERT INTO users (email,password) VALUES ( :email , :password);";
            $statement = MyPDO::getInstance()->prepare($query);
            $statement->execute([':email' => $this->email, ':password' => $this->password]);
            $id = MyPDO::getInstance()->lastInsertId();
            echo "Inscription OK" . PHP_EOL;
            return $id;
        } else {
            echo "Inscription FAIL" . PHP_EOL;
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM users WHERE id=:id;";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute([':id' => $id]);
        $result = $statement->fetch();
        $mail = $result['email'];
        $mdp = $result['password'];
        $entry = [$mail,$mdp];
        return $entry;
    }

    public function update($id,$email,$mdp)
    {
        $query = "UPDATE users SET email = :email, password = :mdp WHERE id = :id;";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute([':email' => $email, ':mdp' => $mdp, ':id' => $id]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id;";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute([':id' => $id]);
    }

    public function read_all()
    {
        $query = "SELECT * FROM users";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}


