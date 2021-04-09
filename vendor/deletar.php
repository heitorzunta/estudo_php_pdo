<?php

use Alura\Pdo\Infrastructure\Persistence\connectionFactory;

require_once "autoload.php";


$pdo = connectionFactory::connection();


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