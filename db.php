<?php

class Database {
    private $dsn = 'mysql:host=localhost;dbname=php_oops_crud';
    private $username = 'root';
    private $password = 'Diaa@2010856015';
    private $connection;

    public function __construct(){
        try {
            $this->connection = new PDO($this->dsn, $this->username, $this->password);
        }catch (PDOException $PDOException){
            echo $PDOException->getMessage();
        }
    }

    public function insertUser($fname, $lname, $email, $phone){
        $sql = "insert into users (first_name, last_name, email, phone) values (?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$fname, $lname, $email, $phone]);
        return true;
    }
    public function getAllUsers(){
        $data = array();
        $sql = "select * from users";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        //this line will fetch the recourds in assoc array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // here we store all data into $data[] array
        foreach ($result as $row){
            $data[] = $row;
        }
        return $data;
    }
    public function getUserById($id){
        $sql = "select * from users where id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function updateUser($id, $fname, $lname, $email, $phone){
        $sql = "update users set first_name=?, last_name=?, email=?, phone=? where id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$fname, $lname, $email, $phone, $id]);
        return true;
    }
    public function deleteUser($id){
        $sql = "delete from users where id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return true;
    }
    public function totalRowCount(){
        $sql = "select * from users";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();
        return $totalRows;
    }


}


