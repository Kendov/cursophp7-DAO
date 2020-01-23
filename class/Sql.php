<?php

class Sql extends PDO{
    private $conn;
    public function __construct(
        String $host = "localhost", 
        String $dbname = "dbphp7", 
        string $login = "root", 
        string $password = ""){

        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);

    }
    private function setParams($statement, $parameters = []){

        foreach($parameters as $key => $value){
    
            $this->setParam($statement, $key, $value);
    
        }
    }
    private function setParam($statement, $key, $value){
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = []){
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = []):array{
        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
}

?>
