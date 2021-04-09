<?php

use Alura\Pdo\Infrastructure\Persistence\connectionFactory;
use Alura\Pdo\Domain\Model\Student;

require_once "autoload.php";

$pdo = connectionFactory::connection();


$student = new Student(
    $int = null,
    $name = 'Geciani Mirian Silva',
    $bithDate = new DateTimeImmutable('22-10-1983')
);

$sqlInsert = 'INSERT INTO students
     (name, birthDate)
      VALUES
      (:name, :birthDate);';    
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birthDate', $student->birthDate()->format('Y-m-d'));

if($statement->execute()){
    echo 'Aluno incluso!';
}
else{
    echo 'Erro ao incluir aluno';
}
?>