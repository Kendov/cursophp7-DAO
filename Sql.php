<?php

class Sql extends PDO{
    private $conn;

    public function __construct($host, $dbname, string $login, string $password){

        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);

    }
    private function setParams($statment, $parameters = []){

        foreach($parameters as $key => $value){
    
            $this->setParam( $key, $value);
            //$this->setParam($statment, $key, $value)
    
        }
    }
    private function setParam($statment, $key, $value){
        $statment->bindParam($key, $value);
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
