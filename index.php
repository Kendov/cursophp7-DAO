<?php
require_once('config.php');

//old version
// $sql = new Sql("localhost","dbphp7","root", "");
// $usuarios = $sql->select("SELECT * FROM tb_usuarios");
// echo json_encode($usuarios);

//load one user
// $root = new Usuario;
// $root->loadByid(1);
// echo $root;


//load a list of user
//$list = Usuario::getList();
//echo json_encode($list);

//load a list of users by login
// $search = Usuario::search("jo");
// echo json_encode($search);

//load a user by login and password
// $login = new Usuario;
// $login->login("user", 12345);
// echo $login;

//set new user
// $user = new Usuario("aluno2", "asd123");
// $user->insert();
// echo $user;

//update
// $user = new Usuario;
// $user->loadByid(8);
// $user->update("newaluno2", "dsa321");
// echo $user;

//Delete
$user = new Usuario;
$user->loadByid(10);

$user->delete();
echo $user;

?>