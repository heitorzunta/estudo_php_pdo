<?php

$path = __DIR__ . '/banco.sqlite';
/*
* dsn é uma string de conexão que o PDO utiliza para conectar a um determinado banco, neste caso estamos usando o sqlite.
* Caso queira modificar o banco basta trocar o dsn.
* estrutura: driver:informacoes_especificas_do_driver
*/
$dsn = 'sqlite:' . $path;
$pdo = new PDO($dsn);

echo 'Conectado com sucesso'.PHP_EOL;


$request = 'CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT, birthDate TEXT)';

var_dump($pdo->exec($request));

?>