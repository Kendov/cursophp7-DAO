<?php
require_once('config.php');

$sql = new Sql("localhost","dbphp7","root", "");

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);


?>