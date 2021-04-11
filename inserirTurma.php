<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionFactory;
use Alura\Pdo\Infrastructure\Repository\PdoRepositoryStudents;

require_once 'vendor/autoload.php';

$conn = ConnectionFactory::connection();

$turma = new PdoRepositoryStudents($conn);

$aluno_1 = new Student(
    null, 
    "Guilherme Ferrari", 
    new DateTimeImmutable ('1983-03-07')
);

$aluno_2 = new Student(
    null, 
    'Maria Amelia Marques', 
    new DateTimeImmutable('1976-07-17'));


//Iniciando uma transaçao no banco de dados  

try {
    $conn->beginTransaction();

    $turma->save($aluno_1);
    $turma->save($aluno_2);

    //Salvando as transacoes no banco de dados
    $conn->commit();
    //Caso não queira salvar as transaçoes posso usar um
    // rollback();
    //$conn->rollBack();
} catch (PDOException $e){
    echo $e->getMessage();
    $e->errorInfo[2];
    $conn->rollBack();
}
?>



