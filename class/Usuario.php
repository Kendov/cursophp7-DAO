<?php

class Usuario{
    private $idususario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


    public function getIdusuario(){
        return $this->idususario;
    }
    public function setIdusuario($value){
        $this->idususario = $value;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }
    public function setDeslogin($value){
        $this->deslogin = $value;
    }


    public function getDessenha(){
        return $this->dessenha;
    }
    public function setDessenha($value){
        $this->dessenha = $value;
    }


    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }


    public function loadByid($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID" , [":ID"=>$id]);
        
        if(isset($results[0])){

            $this->setData($results[0]);
        }

        return json_encode([
            "idususario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ]);
    }


    public static function getList(){
        $sql = new Sql;

        return $sql->select("SELECT * From tb_usuarios ORDER BY deslogin;");
    }

    public static function search($login){
        $sql = new Sql;
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",[
            ':SEARCH'=>"%".$login."%"
        ]);
    }

    public function login($login, $password){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD" , [
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
            ]);
        
        if(isset($results[0])){
            
            $this->setData($results[0]);
            
        }else {
            throw new Exception("login or password invalid");
            
        }
    }
    public function setData($data){
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function insert(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",[
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ]);

        if(isset($results[0])){
            $this->setData($results[0]);
        }
    }

    public function update($login, $password){
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql;
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", [
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha(),
            ":ID"=>$this->getIdusuario()
        ]);
    }

    public function delete(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID",[
            ":ID"=>$this->getIdusuario()
        ]);
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime);
    }

    public function __construct($login = "", $password = ""){
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    public function __toString(){
        return json_encode([
            "idususario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ]);
    }
}

?>