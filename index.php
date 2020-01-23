<?php
require_once('config.php');

//old version
// $sql = new Sql("localhost","dbphp7","root", "");
// $usuarios = $sql->select("SELECT * FROM tb_usuarios");
// echo json_encode($usuarios);

$root = new Usuario;
$root->loadByid(1);
echo $root;





?>