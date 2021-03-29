<?php
require_once "autoload.php";


$path = __DIR__ . '/banco.sqlite';
$dsn = 'sqlite:' . $path;
$pdo = new PDO($dsn);

echo 'Conectado com sucesso'.PHP_EOL;


$sqlDelete = 'DELETE FROM students WHERE id LIKE :id;';
$statementPrepared = $pdo->prepare($sqlDelete);
$statementPrepared->bindValue(':id', 4, PDO::PARAM_INT);


if($statementPrepared->execute()){
    echo 'DELETADO COM SUCESSO';
}
else {
    echo 'ERRO NA DELECAO';
}

?>